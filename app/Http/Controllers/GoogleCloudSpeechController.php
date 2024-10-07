<?php

namespace App\Http\Controllers;

use Session;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\StreamingRecognitionConfig;

class GoogleCloudSpeechController extends Controller
{
  function speechToText(){
    
    $recognitionConfig = new RecognitionConfig();
    $recognitionConfig->setEncoding(AudioEncoding::FLAC);
    $recognitionConfig->setSampleRateHertz(44100);
    $recognitionConfig->setLanguageCode('en-US');
    $config = new StreamingRecognitionConfig();
    $config->setConfig($recognitionConfig);

    $audioResource = fopen('https://test.dentistryinanutshell.com/lara/dev/dian/public/audio/sample-15s.mp3', 'r');

    $responses = $speechClient->recognizeAudioStream($config, $audioResource);

    foreach ($responses as $element) {
        print_r($element);
        // doSomethingWith($element);
    }
  }

  function voiceRecorder(){
    
    return view('voiceRecorder');
  }

  function saveAudio(Request $request){
    $audio = $request->file('audio');
        
        // Use Google Cloud Speech-to-Text API to transcribe audio
        
        $transcribedText = "This is a transcribed text from audio."; // Replace with actual transcription
        
        return response()->json(['transcribedText' => $transcribedText]);
  }
}
