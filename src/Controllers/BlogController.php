<?php

namespace Acr\Acr_blog\Controllers;

use Acr\Acr_blog\Models\Blog_makale;
use App\Handlers\Commands\my;
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
    function sira_update(Request $request)
    {
        $sira  = $request->sira;
        $id    = $request->id;
        $model = new Blog_makale();
        $model->where('id', $id)->update(['sira' => $sira]);
    }

    function blog_galery(my $my)
    {
        $blog_views = self::blog_views($my);
        return view('Acr_blogv::blog_galery', compact('blog_views'));
    }

    function blog_views($my)
    {
        $blog_model = new Blog_makale();
        $blogs      = $blog_model->with(['file'])->orderBy('sira', 'desc')->paginate(30);
        return view('Acr_blogv::blog_views', compact('blogs', 'my'))->render();
    }

    function blogSayYaz($sayi, $yazi)
    {
        if (strlen($yazi) < $sayi) {
            echo $yazi;
        } else {
            $yazilacak     = explode(' ', substr($yazi, 0, $sayi));
            $yazilacakSayi = count($yazilacak);
            for ($i = 0; $i < $yazilacakSayi - 1; $i++) {
                echo $yazilacak[$i] . ' ';
            }
        }
    }

    function blog_oku(Request $request, my $my)
    {
        $id         = $request->id;
        $blog_model = new Blog_makale();
        $blog       = $blog_model->with(['file'])->where('id', $id)->first();
        $blogs      = $blog_model->with(['file'])->where('id', '!=', $id)->orderBy('sira', 'desc')->paginate(20);
        return view('Acr_blogv::blog', compact('blog', 'blogs', 'my'));

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
            $blog_model->where('id', $id)->update(['sira' => $id]);
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
        return view('Acr_blogv::index', compact('blogs'));
    }

    function delete(Request $request)
    {
        $blog_model = new Blog_makale();
        $blog_model->where('id', $request->id)->delete();
    }
}
