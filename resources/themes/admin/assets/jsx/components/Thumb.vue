<template>
    <div class="item-list col-xs-6 col-sm-4 col-md-3 col-lg-2" data-id="{{ data.id }}" style="max-width: 168px;">
       <div class="item thumbnail">
            
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            data: []
        }
    }
    mounted() {
        this.axios.get()
    }
}
</script>