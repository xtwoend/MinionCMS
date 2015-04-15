<?php namespace Minion\Core;

use Dflydev\DotAccessData\Data;
use \Minion\Core\ContentParser;
use Slim\Slim;

class Gear {

	protected $config;	
	protected $contentParser;
	protected $blogPath;
	/**
	 * contruct.
	 *
	 * @return
	 */
	public function __construct()
	{
		// Config
		$this->config = $this->loadConfigs();
		$this->contentParser = new ContentParser;
	}

	/**
	 * load config.
	 *
	 * @return
	 */
	protected function loadConfigs()
	{
		$configData = [];

		$rdi = new \RecursiveDirectoryIterator(APP_PATH . 'config/');
		$rii = new \RecursiveIteratorIterator($rdi);
		$ri = new \RegexIterator($rii, '/(.*)\.php/', \RegexIterator::GET_MATCH);
		$configFiles = array_keys(iterator_to_array($ri));

		foreach ($configFiles as $configFile) {
			$configKey = str_replace(APP_PATH . 'config' . DIRECTORY_SEPARATOR, '', $configFile);
			$configKey = str_replace(DIRECTORY_SEPARATOR, '-', strtolower($configKey));
			$configKey = str_replace('.php', '', $configKey);
			$configData[$configKey] = require $configFile;
		}

		return new Data($configData);
	}

	/**
	 * get config.
	 *
	 * @return
	 */
	public function config()
	{
		return $this->config;
	}

	/**
	 * config.
	 *
	 * @return
	 */
	public function initConfig()
	{
		//app config
		$config = [
			'mode' => $this->config->get('app.mode'),
			'debug' => $this->config->get('app.debug'),
			'view' => $this->config->get('view.engine'),
			'routes.case_sensitive' => $this->config->get('app.routes.case_sensitive'),
			'templates.path' => $this->config->get('view.views') . $this->config->get('view.themes')
		];

		foreach ($this->config->get('cookies') as $key => $value) {
			$config['cookies.'.$key] = $value; 
		}
		
		foreach ($this->config->get('database') as $key => $value) {
			$config['database.'.$key] = $value; 
		}

		foreach ($this->config->get('app.log') as $key => $value) {
			$config['log.'.$key] = $value; 
		}

		return $config;
	}

	/**
	 * .
	 *
	 * @return
	 */
	public function init()
	{			
		//run slim
		$app = new Slim($this->initConfig());		
		
		//set view template
		$configView['debug'] = $this->config->get('view.debug');
		$configView['cache'] = $this->config->get('view.cache');		

		$view = $app->view();
		$view->parserOptions = $configView;
		$view->parserExtensions = array(
		    new \Slim\Views\TwigExtension(),
		);
		
		$this->setRoutes($app);

		return $app;
	}

	protected function setRoutes($app)
	{
		$files = $this->readFiles($this->config->get('app.content_path'), $this->config->get('app.content_extension'));
		$posts = null;
		$allPosts = null;
		$postsPagination = [];		
		
		if ($this->blogPath) {
			$allPosts = $this->filesToPosts($files);
			$page = isset($_GET['page']) && $_GET['page'] ? abs(intval($_GET['page'])) : 1;
			$offset = 0;
			if ($page > 1) {
				$offset = $page - 1;
			}

			$posts = array_chunk($allPosts, $this->config->get('blog.posts_per_page'));
			$total_pages = count($posts);
			if (isset($posts[$offset])) {
				$posts = $posts[$offset];
			} else {
				$posts = [];
			}
			$postsPagination = [
				'total_pages' => $total_pages,
				'current_page' => $page,
				'base_url' => $this->config->get('app.base_url') . '/' . $this->config->get('blog.blog_folder')
			];
		}

		$navigation = $this->filesToNav($files, $this->currentUrl());

		$routes = $this->filesToRoutes($files);

		foreach ($routes as $route) {

			$thisroute = ($route['route'] == '/') ? $route['route'] : '/' . $route['route'];

			$app->get($thisroute , function() use ($app, $route, $posts, $allPosts, $postsPagination){
				
				$data = $this->getFileData($route['path']);

				$data['all_posts'] = $allPosts;
				$data['posts'] = $posts;
				$data['pagination'] = $postsPagination;
				$template = 'page.html';
				if (isset($data['info']['template']) && $data['info']['template']) {
					$template = $data['info']['template'];
				}
				$app->render($template, $data);
			});
		}
		
		if ($allPosts) {
			if (!empty($allPosts)) {
				foreach ($allPosts as $post) {

					$thisroute = ($post['route'] == '/') ? $post['route'] : '/' . $post['route'];

					$app->get($thisroute, function() use ($app, $post, $posts, $allPosts, $postsPagination) {
						
						$data = $this->getFileData($post['path']);
						$data['all_posts'] = $allPosts;
						$data['posts'] = $posts;
						$data['pagination'] = $postsPagination;
						$template = 'post.html';
						if (isset($data['info']['template']) && $data['info']['template']) {
							$template = $data['info']['template'];
						}
						$published = date($this->config->get('blog.date_format'));
						if (preg_match('/^\d+\-/', basename($post['path']))) {
							list($time, $path) = explode('-', basename($post['path']), 2);
							$published = date($this->config->get('blog.date_format'), strtotime($time));
						}
						if (isset($data['info']['published'])) {
							$published = date($this->config->get('blog.date_format'), strtotime($data['info']['published']));
						}
						$data['published'] = $published;

						$app->render($template, $data);
					});
				}
			}

			$app->get('/'.$this->config->get('blog.blog_folder'), function() use ($app, $posts, $allPosts, $postsPagination) {
				return $app->render('blog.html', [
					'all_posts' => $allPosts,
					'posts' => $posts,
					'pagination' => $postsPagination,
				]);
			});
		}
	}

	protected function filesToRoutes($files, $route_prefix = '', $path_prefix = '')
	{
		$result = [];
		$blogBase = str_replace($this->config->get('app.content_path'), '', $this->blogPath);

		foreach ($files as $key => $value) {
			if (!is_int($key)) {
				if ($key != $blogBase) {
					if (preg_match('/^\d+\-/', $key)) {
						list($index, $path) = explode('-', $key, 2);
						$result = array_merge($result, $this->filesToRoutes($value, $route_prefix . $path . '/', $path_prefix . $key . '/'));
					} else {
						$result = array_merge($result, $this->filesToRoutes($value, $route_prefix . $key . '/', $path_prefix . $key . '/'));
					}
				}
			} else {
				$route = str_replace($this->config->get('app.content_extension'), '', $value['nice']);
				if ($route == 'index') {
					$route = '/';
				}

				$result[] = [
					'route' => $route_prefix . $route,
					'path' => $path_prefix . $value['raw']
				];
			}
		}

		return $result;
	}

	protected function readFiles($dir, $extension, $top = true)
	{
		$dir = rtrim($dir, '/');
		$result = [];
		$dirs = [];
		$files = [];
		$sdir = scandir($dir);

		foreach ($sdir as $key => $value) {
			if (!in_array($value,array('.','..'))) {
				$ext = pathinfo($value, PATHINFO_EXTENSION);
				if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
					if (!$this->blogPath && ($value == $this->config->get('blog.blog_folder') || preg_match('/^(\d+-)' . $this->config->get('blog.blog_folder') . '/', $value))) {
						$this->blogPath = $dir . DIRECTORY_SEPARATOR . $value;
						$this->config->set('minion.blog_path', $this->blogPath);
					}
					$dirs[$value] = $this->readFiles($dir . DIRECTORY_SEPARATOR . $value, $extension, false);
				} elseif('.' . $ext == $extension) {
					if (preg_match('/^\d+\-/', $value)) {
						list($index, $path) = explode('-', $value, 2);
						$files[$index] = [
							'nice' => $path,
							'raw' => $value
						];
					} else {
						$files[] = [
							'nice' => $value,
							'raw' => $value
						];
					}
				}
			}
		}

		ksort($dirs);
		if ($dir == $this->blogPath) {
			krsort($files);
		} else {
			ksort($files);
		}

		if ($top) {
			$result = array_merge($files, $dirs);
		} else {
			$result = array_merge($dirs, $files);
		}

		return $result;
	}

	protected function filesToNav($files, $currentUri, $route_prefix = '', $path_prefix = '')
	{
		$result = [];
		$blogBase = str_replace($this->config->get('app.content_path'), '', $this->blogPath);

		foreach ($files as $key => $value) {
			if (!is_int($key)) {
				if ($key == $blogBase) {
					$url = basename($blogBase);
					if (preg_match('/^\d+\-/', $url)) {
						list($index, $path) = explode('-', $url, 2);
						$url = $path;
					}

					$result[] = [
						'title'  => ucwords(str_replace(['-', '_'], ' ', $url)),
						'url'    => $url,
						'active' => $url == $currentUri ? true : false
					];
				} else {
					if (preg_match('/^\d+\-/', $key)) {
						list($index, $path) = explode('-', $key, 2);
						$result[$key] = $this->filesToNav($value, $currentUri, $route_prefix . $path . '/', $path_prefix . $key . '/');
					} else {
						$result[$key] = $this->filesToNav($value, $currentUri, $route_prefix . $key . '/', $path_prefix . $key . '/');
					}
				}
			} elseif ($path_prefix != $blogBase . '/') {
				$route = str_replace($this->config->get('app.content_extension'), '', $value['nice']);
				if ($route == 'index') {
					$route = '/';
				}
				if (!$currentUri) {
					$currentUri = '/';
				}

				$data = $this->getFileData($path_prefix . $value['raw']);
				$title = isset($data['info']['title']) ? $data['info']['title'] : '';
				if (!$title) {
					$title = ucwords(str_replace(['-', '_'], ' ', basename($route)));
				}
				$active = false;
				if ($route_prefix . $route == $currentUri) {
					$active = true;
				}

				if (!isset($data['info']['exclude_from_nav']) || !$data['info']['exclude_from_nav']) {
					$result[] = [
						'title'  => $title,
						'url'    => $route_prefix . $route,
						'active' => $active
					];
				}
			}
		}

		return $result;
	}

	protected function filesToPosts($files)
	{
		$result = [];
		$posts = [];
		$blogBase = str_replace($this->config->get('app.content_path'), '', $this->blogPath);

		foreach ($files as $key => $value) {
			if ($key === $blogBase) {
				$posts = $value;
				break;
			}
		}

		foreach ($posts as $post) {
			$route = str_replace($this->config->get('app.content_extension'), '', $post['nice']);
			$routeBase = basename($blogBase);
			if (preg_match('/^\d+\-/', $blogBase)) {
				list($index, $path) = explode('-', $blogBase, 2);
				$routeBase = $path;
			}

			$data = $this->getFileData($blogBase . '/' . $post['raw']);
			$title = isset($data['info']['title']) ? $data['info']['title'] : '';
			if (!$title) {
				$title = ucwords(str_replace(['-', '_'], ' ', basename($route)));
			}
			$excerpt = '';
			if (isset($data['content'])) {
				$excerpt = strip_tags($data['content']);
				$words = explode(' ', $excerpt);
				if (count($words) > $this->config->get('blog.excerpt_words') && $this->config->get('blog.excerpt_words') > 0) {
					$excerpt = implode(' ', array_slice($words, 0, $this->config->get('blog.excerpt_words'))) . '...';
				}
			}
			$published = date($this->config->get('blog.date_format'));
			if (preg_match('/^\d+\-/', $post['raw'])) {
				list($time, $path) = explode('-', $post['raw'], 2);
				$published = date($this->config->get('blog.date_format'), strtotime($time));
			}
			if (isset($data['info']['published'])) {
				$published = date($this->config->get('blog.date_format'), strtotime($data['info']['published']));
			}

			$result[] = [
				'route'     => $routeBase . '/' . $route,
				'path' 	    => $blogBase . '/' . $post['raw'],
				'title'     => $title,
				'info'      => isset($data['info']) ? $data['info'] : '',
				'excerpt'   => $excerpt,
				'published' => $published
			];
		}

		return $result;
	}

	public function base($withUri = true, $appName = 'default')
    {
        $req = Slim::getInstance($appName)->request();
        $uri = $req->getUrl();

        if ($withUri) {
            $uri .= $req->getRootUri();
        }
        return $uri;
    }

    public function currentUrl($withQueryString = false, $appName = 'default')
    {
        $app = Slim::getInstance($appName);
        $req = $app->request();
        $uri = $req->getUrl() . $req->getPath();

        if ($withQueryString) {
            $env = $app->environment();

            if ($env['QUERY_STRING']) {
                $uri .= '?' . $env['QUERY_STRING'];
            }
        }

        return $uri;
    }

    protected function getFileData($route_path)
	{
		$data = null;
		$file_path = $this->config->get('app.content_path') . ltrim($route_path, '/');

		if (file_exists($file_path)) {
			$file_contents = file_get_contents($file_path);
			$data = $this->contentParser->parse($file_contents);
		}

		return $data;
	}
}