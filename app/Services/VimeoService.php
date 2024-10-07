<?php

// app/Services/VimeoService.php

namespace App\Services;

use Vimeo\Vimeo;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;

class VimeoService
{
    protected $client;
    protected $guzzleClient;

    public function __construct()
    {
        $this->client = new Vimeo(
            env('VIMEO_CLIENT_ID'),
            env('VIMEO_CLIENT_SECRET'),
            env('VIMEO_ACCESS_TOKEN')
        );

        $this->guzzleClient = new Client();
    }

    public function uploadVideo($filePath, $title, $description)
    {
        try {
            $uri = $this->client->upload($filePath, [
                'name' => $title,
                'description' => $description

            ]);
            return ['uri' => $uri];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function uploadThumbnail($videoUri, $thumbnailPath)
    {
        try {
            // Request an upload link for the thumbnail
            $response = $this->client->request("$videoUri/pictures", ['type' => 'custom'], 'POST');
            $body = $response['body'];

            if (isset($body['error'])) {
                return ['error' => $body['error']];
            }

            $uploadLink = $body['link'];
            $pictureUri = $body['uri'];

            // Upload the thumbnail image using Guzzle
            $uploadResponse = $this->guzzleClient->request('PUT', $uploadLink, [
                'body' => fopen($thumbnailPath, 'r'),
                'headers' => [
                    'Content-Type' => 'image/jpeg' // Adjust this based on your file type
                ]
            ]);

            if ($uploadResponse->getStatusCode() !== 200) {
                return ['error' => 'Failed to upload thumbnail'];
            }

            // Activate the thumbnail
            $this->client->request("$pictureUri/activate", [], 'PUT');

            return ['success' => true];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
    public function getVideoIdFromUri($videoUri)
    {
        $parts = explode('/', $videoUri);
        return end($parts);
    }

    public function getVideoDetails($videoUri)
    {
        try {
            $response = $this->client->request($videoUri);
            return $response['body']; // This should contain the video details including duration
        } catch (\Exception $e) {
            return ['error' => 'Unable to get video details from Vimeo: ' . $e->getMessage()];
        }
    }

    public function addDomainsToWhitelist($videoId, array $domains)
    {
        try {
            foreach ($domains as $domain) {
                $response = $this->client->request(
                    "/videos/{$videoId}/privacy/domains/{$domain}",
                    [],
                    'PUT'
                );

                if ($response['status'] !== 204) { // 204 is the expected status for success with no content
                    return ['error' => "Failed to add domain: $domain"];
                }
            }

            return ['success' => true];
        } catch (\Exception $e) {
            return ['error' => 'Failed to add domains to whitelist: ' . $e->getMessage()];
        }
    }


    public function setVideoPrivacy($videoId, $privacy = 'disable')
    {
        try {
            $response = $this->client->request("/videos/{$videoId}", [
                'privacy' => [
                    'view' => $privacy,
                    'embed' => 'whitelist'
                ]
            ], 'PATCH');

            if ($response['status'] !== 200) {
                return ['error' => 'Failed to set video privacy'];
            }

            return ['success' => true];
        } catch (\Exception $e) {
            return ['error' => 'Failed to set video privacy: ' . $e->getMessage()];
        }
    }


    public function getVideos()
    {
        try {
            $response = $this->client->request('/me/videos', [], 'GET');
            return $response['body'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
