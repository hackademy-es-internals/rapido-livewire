<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionRemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    
    private $image_id;
    /**
    * Create a new job instance.
    *
    * @return void
    */
    public function __construct($image_id)
    {
        $this->image_id=$image_id;
    }
    
    /**
    * Execute the job.
    *
    * @return void
    */
    public function handle()
    {
        
        $i = Image::find($this->image_id);
        if(!$i){
            return;
        }
        
        $image = file_get_contents(storage_path('app/public/'.$i->path));
        
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.base_path('google_credentials.json'));
        
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->faceDetection($image);
        $imageAnnotator->close();

        $faces = $response->getFaceAnnotations();
        foreach ($faces as $face) {
            $vertices = $face->getBoundingPoly()->getVertices();
            echo "face\n";
            foreach ($vertices as  $vertex) {
                echo $vertex->getX() . "," . $vertex->getY() . "\n";
            }
        }
    }
}
