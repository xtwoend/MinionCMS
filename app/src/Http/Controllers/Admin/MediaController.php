<?php

namespace Minion\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Minion\Entities\Media;
use Minion\Http\Controllers\Controller;
use Minion\Themes\Facades\Themes;

class MediaController extends Controller
{
    protected $media;
    protected $filesystem;

    protected $types = [
        'image' => ['png', 'jpg', 'jpeg', 'gif'],
        'audio' => ['mp3', 'wav', 'mpga'],
        'video' => ['mp4', 'avi'],
        'zip'   => ['zip', 'rar', '7z', 'tar', 'gz', 'tar.gz']
    ];

    public function __construct(Media $media, FilesystemManager $filesystem)
    {
        $this->media = $media;
        $this->filesystem = $filesystem;
        Themes::set('admin');
    }

    /**
     * [index description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        return view('media.index');
    }

    public function create()
    {
        return view('media.upload');
    }

    public function imgEdit($id)
    {
        $row = $this->media->find($id);
        return view('media.imgedit', compact('row'));
    }

    public function getMedia(Request $request)
    {
        $ids = $request->get('ids');
        $response = '';
        
        if(is_array($ids) && count($ids) === 1){
            $row  = $this->media->findOrFail($ids[0]);
            if($row->type == 'image'){
                $url = $row->url;
                if($request->has('dimension') && $row->type == 'local'){
                    $url = route('image', [$row->filepath, 'size' => $request->dimension]);
                }
                $response = '<img src="'.$url.'" class="img-responsive">';
            }else{
                $response = '<a href="'.$row->url.'">'.$row->name.'</a>';
            }
        }else {
            $row = $this->media->whereIn('id', $ids)->get();
            foreach($row as $r){
                if($r->type == 'image'){
                    $response .= '<img src="'.$r->url.'" class="img-responsive">';
                }else{
                    $response .= '<a href="'.$r->url.'">'.$r->name.'</a>';
                }
            }
        }

        return response()->json([
            'success' => true,
            'data' => $row,
            'response' => $response,
        ]);
    }

    public function mediaDetail($id)
    {
        $row  = $this->media->find($id);
        return response()->json([
            'success' => true,
            'html'    => (string)view('media.attach', compact('row'))  
        ], 200);
    }

    public function items(Request $request)
    {   
        $rows = $this->media->latest();

        if($request->has('type') && $request->type !== 'all'){
            $rows = $rows->whereType($request->type);
        }
        if($request->has('time')  && $request->time !== 'all'){
            $time = $request->time;
            $timeFromat = Carbon::createFromFormat('F Y', $time);
            $rows = $rows->whereYear('created_at', '=', $timeFromat->format('Y'))
                        ->whereMonth('created_at', '=', $timeFromat->format('m'));
        }
        if($request->has('search')){
            $rows = $rows->where('name', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('description', 'LIKE', '%'.$request->search.'%');
        }


        $rows = $rows->paginate(30);
        
        return response()->json([
            'success' => true,
            'data'  => $rows->items(),
            'meta'  => [
                'url'   => $rows->nextPageUrl(),
                'page'  => $rows->currentPage(),
            ],
            // 'input' => $request->all()
        ], 200);
    }

    public function destroy($id)
    {
        $this->media->find($id)->delete();   

        return response()->json([
                'success' => true,
                'message' => 'File has been delete'
            ], 200);
    }

    public function upload(Request $request)
    {  
        if($request->hasFile('file') && $request->file('file')->isValid()){
            
            $extension = $request->file->extension();
            $filename = $request->file->getClientOriginalName();
            $mimetype = $request->file->getMimeType();
            $filesize = $request->file->getClientSize();

            $hashname = str_random(15) . '.' . $extension;

            $path = $request->file->storeAs('public'.DIRECTORY_SEPARATOR.$this->folder(), $hashname);
            $url = Storage::url($path);

            $fileType = 'file';
            foreach ($this->types  as $type => $lists) {
                if(in_array($extension, $lists)){
                    $fileType = $type;
                }
            }
            $thumb_url = NULL;
            if($fileType === 'image')
            {
                $pathReal = (config('config.disks') === 'local')? public_path($url) :  $url;
                $img = Image::make($pathReal);
                $stream = $img->fit(180, 180)->encode($extension);
                $pathtumb = 'public'.DIRECTORY_SEPARATOR.$this->folder().DIRECTORY_SEPARATOR.'thumbs' . DIRECTORY_SEPARATOR . $hashname;
                Storage::put($pathtumb, (string) $stream);
                $thumb_url = Storage::url($pathtumb);
            }

            $row = $this->media;
            $row->filename  = $hashname;
            $row->extension = $extension;
            $row->mimetype  = $mimetype;
            $row->filesize  = $filesize;
            $row->filepath  = $path;
            $row->url       = $url;
            $row->thumb     = $thumb_url;
            $row->disk      = config('config.disks');
            $row->type      = $fileType;
            $row->name      = $filename;
            $row->save();

            return response()->json([
                'success' => true,
                'data'    => $row,
                'thumb'   => $thumb_url
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Error file format'
        ], 500);
    }

    /**
     * [getImage description]
     * @param  [type] $size     [description]
     * @param  [type] $filename [description]
     * @return [type]           [description]
     */
    public function getImage($filename, Request $request)
    {   
        $size = explode('x', $request->get('size', '128x128'));

        $path = $this->getImagePath($filename);
        
        $manager = new ImageManager(config('image'));

        $content = $manager->cache(function ($image) use ($size, $path) {
            $img = $image->make($path);
        
            if (in_array('null', $size)) {
                return $img->resize($size[0], $size[1], function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                return $img->fit($size[0], $size[1]);
            }

        }, config('imagecache.lifetime'));
        

        return $this->buildResponse($content);
    }

    public function themeThumb($name)
    {
        $theme = app('themes')->find($name);
        if(! empty($theme)){
            $path = $theme->path;
            if(file_exists($file = $path.DIRECTORY_SEPARATOR.'theme.png')){
                $img = Image::make($file);
                return $img->response();
            }
        }   
        return '';
    }

    /**
     * Returns full image path from given filename
     *
     * @param  string $filename
     * @return string
     */
    private function getImagePath($filename)
    {
        // find file
        foreach (config('imagecache.paths') as $path) {
            // don't allow '..' in filenames
            $image_path = $path . '/' . str_replace('..', '', $filename);
            if (file_exists($image_path) && is_file($image_path)) {
                // file found
                return $image_path;
            }
        }

        // file not found
        abort(404);
    }

    /**
     * Builds HTTP response from given image data
     *
     * @param  string $content
     * @return Illuminate\Http\Response
     */
    private function buildResponse($content)
    {
        // define mime type
        $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $content);

        // return http response
        return new IlluminateResponse($content, 200, array(
            'Content-Type' => $mime,
            'Cache-Control' => 'max-age=' . (config('imagecache.lifetime') * 60) . ', public',
            'Etag' => md5($content),
        ));
    }


    private function folder()
    {
        $date = Carbon::now()->format('Y/m');
        return $date;
    }
}
