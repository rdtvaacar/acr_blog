<?php

namespace Acr\Acr_blog\Controllers;

use Acr\Acr_blog\Models\Blog_makale;
use DB,
    Input,
    Validator,
    Auth,
    Redirect,
    Session;
use Illuminate\Http\Request;
use Acr_fl;
use Image;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    function blog_oku(Request $request)
    {
        $id         = $request->id;
        $blog_model = new Blog_makale();
        $blog       = $blog_model->with(['file'])->where('id', $id)->first();
        $blogs      = $blog_model->with(['file'])->where('id', '!=', $id)->get();
        return view('Acr_blogv::blog', compact('blog', 'blogs'));

    }

    function create(Request $request)
    {
        $name       = $request->name;
        $icerik     = $request->icerik;
        $id         = $request->id;
        $blog_model = new Blog_makale();
        $sayi       = $blog_model->where('id', $id)->count();
        if ($sayi > 0) {
            $data = [
                'name' => $name,
                'icerik' => $icerik,
            ];
            $blog_model->where('id', $id)->update($data);
        } else {
            $data = [
                'name' => $name,
                'icerik' => $icerik,
            ];
            $blog_model->insert($data);
        }

        /*$file            = $request->file('file');
        if (!empty($file)) {
            $acr_files_model = new Acr_files_childs();
            $file_name_dot = $file->getClientOriginalName();
            $dot           = $file->getClientOriginalExtension();
            $file_name_org = str_replace('.' . $dot, '', $file_name_dot);
            $file_name     = $my->ingilizceYap($file_name_org);
            $file_size     = $file->getClientSize();
            if (file_exists(base_path() . '/acr_files/' . $acr_file_id . '/' . $file_name_org)) {
                $file_name_org = $file_name_org . '_' . uniqid(rand(100000, 999999));
            }
            $path   = base_path() . '/public_html/acr_files/' . $acr_file_id . '/';
            $thumbs = $path . 'thumbs/';
            if (!is_dir($path)) {
                mkdir($path);

            }
            if (!is_dir($thumbs)) {
                mkdir($thumbs);

            }
            Image::make($file)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($thumbs . $file_name_dot);
            Image::make($file)
                ->resize(1920, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path . $file_name_dot);
            $data_file = [
                'acr_file_id' => $acr_file_id,
                'file_name_org' => $file_name_org,
                'file_name' => $file_name,
                'file_size' => $file_size,
                'file_type' => $dot,
            ];
            $acr_files_model->insert($data_file);
         }*/

        return redirect()->back()->with('msg', self::basarili());
    }

    function yeni(Request $request)
    {
        $id         = $request->id;
        $blog_model = new Blog_makale();
        $blog       = $blog_model->with(['file'])->where('id', $id)->first();
        if (empty($blog->acr_file_id)) {
            $acr_file_id = Acr_fl::acr_file_id();
            $data        = [
                'acr_file_id' => $acr_file_id
            ];
            $id          = $blog_model->insertGetId($data);
            return redirect()->to('/acr/blog/yeni?id=' . $id);
        } else {
            $acr_file_id = $blog->acr_file_id;
        }
        $fl_data = [
            'acr_file_id' => $acr_file_id
        ];
        return view('Acr_blogv::yeni', compact('blog', 'fl_data', 'acr_file_id'));
    }

    function blog()
    {
        $blog_model = new Blog_makale();
        $blogs      = $blog_model->with(['file'])->get();
        return view('Acr_blogv::index', compact('blogs'))->render();
    }

    function delete(Request $request)
    {
        $blog_model = new Blog_makale();
        $blog_model->where('id', $request->id)->delete();
    }

    function file_delete(Request $request)
    {
        $file_model = new Acr_files_childs();
        $file       = $file_model->where('id', $request->id)->first();
        @unlink(base_path() . '/public_html//acr_files/' . $file->acr_file_id . '/thumbs/' . $file->file_name . '.' . $file->file_type);
        @unlink(base_path() . '/public_html/acr_files/' . $file->acr_file_id . '/' . $file->file_name . '.' . $file->file_type);
        $file_model->where('id', $request->id)->delete();
    }
}
