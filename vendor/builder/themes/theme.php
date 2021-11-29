<?php

class SaaS_Doctor_My_Theme extends SaaS_Doctor_Theme_Base{

    function saas_doctor_manage_action(){
        parent::saas_doctor_manage_action();
        return true;
    }

}

abstract class SaaS_Doctor_Theme_Base{

    protected function saas_doctor_manage_action(){

        add_filter('template_include', [$this, 'saas_load_archive_template']);
    }

    public function saas_load_archive_template($template){


        if(is_single()){
            return BUILDER_PATH.'/themes/single.php';
        }
        if(is_search()){
            return BUILDER_PATH.'/themes/search.php';
        }

        if(is_404()){
           return BUILDER_PATH.'/themes/404.php';
        }

        if(is_author()){
           return BUILDER_PATH.'/themes/author.php';
        }

        if(is_archive()){
            return BUILDER_PATH.'/themes/archive.php';
        }

        return $template;
    }

}