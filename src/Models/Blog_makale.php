<?php


namespace Acr\Acr_blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog_makale extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $table      = 'blog_makale';

    function file()
    {
        return $this->hasOne('Acr\Acr_fl\Models\Acr_files_childs', 'acr_file_id', 'acr_file_id');
    }
}