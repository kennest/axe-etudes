<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 06/04/17
 * Time: 19:36
 */

namespace App\Repositories;


use App\Model\Galerie;
use App\Model\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagine\Gd\Image;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class GalerieRepository
{
    const MAX_PHOTOS_PER_GALERY = 15;
    const MAX_GALERY = 6;
    const MAX_PHOTO_SIZE=1024000;

    function __construct()
    {

    }

    public function create(Request $request){
        $galerie=new Galerie();
        $galerie->titre=$request->input('titre');
        $galerie->etablissement()->associate(Auth('etablissements')->user());
        $galerie->save();
    }

    public function update(Request $request,$id){
        $galerie=Galerie::FindOrFail($id);
        $galerie->titre=$request->input('titre');
        $galerie->update();
    }

    public function storePhoto(Request $request)
    {
        $photoDir = 'Galerie/' . Auth('etablissements')->user()->sigle . '/photos';

        $galerie = Galerie::FindOrFail($request->input('galerie'));
        foreach (Input::file('path') as $item) {
            if($this->hasPhotosQuotas($galerie)){
                if ($item->getSize() > $this::MAX_PHOTO_SIZE) {
                    $request->session()->flash('error', 'Les ou L\'une des photos depasse 1024Ko');
                } else {
                    $photo = new Photo();

                    $extention = $item->clientExtension();

                    //On upload les photos dans le dossier galerie avec le sigle de l'etablissement
                    $path = $item->store($photoDir, 'public');

                    //On genere le thumbnail de la photo et on recupere son path
                    $thumb = $this->makeThumbnail(storage_path('app/public/' . $path), $extention);

                    //On extrait seulement le nom de la photo
                    $path = Str::replaceFirst($photoDir, "", $path);
                    $path = Str::replaceFirst('/', "", $path);

                    //On extrait seulement le nom du thumbnail
                    $thumb = Str::replaceFirst(storage_path('app/public/' . $photoDir . '/thumbs'), "", $thumb);
                    $thumb = Str::replaceFirst('/', "", $thumb);

                    $photo->path = $path;
                    $photo->thumbnail = $thumb;
                    $photo->galerie()->associate($galerie);
                    $photo->save();
                    $request->session()->flash('success', 'Operation reussi!');

                }
            }else{
                $request->session()->flash('error','Le Quota de '.$this::MAX_PHOTOS_PER_GALERY.' photos par galerie est atteint!');
            }
        }
    }

    public function updatePhoto(Request $request, $id)
    {
        $photoDir = 'Galerie/' . Auth('etablissements')->user()->sigle . '/photos/';
        $photo = Photo::FindOrfail($id);

        $file = $request->file('path');

        //On recupere l'extension
        $extention = $file->clientExtension();

        //Declaration des repertoires de la photo courante et thumbnail courant
        $oldfile = $photo->path;
        $oldthumb = $photo->thumbnail;

        //On upload les photos dans le dossier galerie avec le sigle de l'etablissement
        $path = $file->store($photoDir, 'public');

        //On genere le thumbnail de la photo et on recupere son path
        $thumb = $this->makeThumbnail(storage_path('app/public/' . $path), $extention);

        //On extrait seulement le nom de la photo
        $path = Str::replaceFirst($photoDir, "", $path);
        $path = Str::replaceFirst('/', "", $path);

        //On extrait seulement le nom du thumbnail
        $thumb = Str::replaceFirst(storage_path('app/public/' . $photoDir . '/thumbs'), "", $thumb);
        $thumb = Str::replaceFirst('/', "", $thumb);

        $photo->path = $path;
        $photo->thumbnail = $thumb;
        if ($photo->update()) {
            File::delete(storage_path('app/' . $oldfile));
            File::delete(storage_path('app/' . $oldthumb));
        }
    }

    public function destroyPhoto($id)
    {
        $photo = Photo::FindOrfail($id);
        $oldfile = $photo->path;
        $oldthumb = $photo->thumbnail;
        if ($photo->delete()) {
            File::delete(storage_path('app/' . $oldfile));
            File::delete(storage_path('app/' . $oldthumb));
        }
    }

    /**
     * ********************************************************PRIVATE FUNCTION**************************************************************************
     */

    /**
     * FONCTION DE CREATION DE THUMBNAIL
     * */
    private function makeThumbnail($imgPath, $extension)
    {
        //Dossier des thumbnails
        $THUMB_DIR = storage_path('app/public/Galerie/' . Auth('etablissements')->user()->sigle . '/photos/thumbs/');

        $thumbName = '';

        //Creation du dossier de thumbnails si inexistant
        Storage::exists('public/Galerie/' . Auth('etablissements')->user()->sigle . '/photos/thumbs/') or
        Storage::makeDirectory('public/Galerie/' . Auth('etablissements')->user()->sigle . '/photos/thumbs/');

        //creation du thumbnail D=300x300
        $imagine = new Imagine();
        $image = $imagine->open($imgPath);
        $thumbnail = $image->thumbnail(new Box(300, 300));

        //On declare le repertoire de sauvegarde du thumbnail  ainsi que son nom
        $thumbName = $THUMB_DIR . Str::random(8) . Auth('etablissements')->user()->sigle . '.' . $extension;

        //sauvegarde du thumbnails dans le dossier THUMB_DIR avec son extension
        $thumbnail->save($thumbName);


        //on le retourne pour stockage dans la base de donnees
        return $thumbName;
    }


    /**
     * @param Galerie $galerie
     * @return bool
     * FONCTION D'ALLOCATION DE QUOTA DE PHOTOS PAR GALERIE
     */
    private function hasPhotosQuotas(Galerie $galerie)
    {
        if (($galerie->photos()->count()) >= ($this::MAX_PHOTOS_PER_GALERY)) {
            return false;
        } else {
            return true;
        }
    }


    /***
     * FONCTION D'ALLOCATION DE QUOTAS DE GALERIE
     */
    private function hasGalerieQuotas(){
        if ((Auth::guard('etablissements')->user()->galeries()->count()) >= ($this::MAX_GALERY)) {
            return false;
        } else {
            return true;
        }
    }

}