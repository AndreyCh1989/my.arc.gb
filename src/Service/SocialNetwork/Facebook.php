<?php


namespace Service\SocialNetwork;


use Facebook\Exceptions\FacebookSDKException;
use Facebook\FacebookRequest;

class Facebook implements SocialNetworkInterface
{
    private $client;

    public function __construct(string $app_id, string $app_secret)
    {
        try {
            $this->client = new \Facebook\Facebook([
                'app_id' => $app_id,
                'app_secret' => $app_secret,
                'graph_api_version' => 'v5.0'
            ]);
        } catch (FacebookSDKException $e) {
        }
    }

    public function uploadPhoto(string $photo)
    {
        try {

            // Upload to a user's profile. The photo will be in the
            // first album in the profile. You can also upload to
            // a specific album by using /ALBUM_ID as the path
            $response = (new FacebookRequest(
                $this->client, 'POST', '/me/photos', array(
                    'source' => new CURLFile('path/to/file.name', 'image/png'),
                    'message' => 'User provided message'
                )
            ))->execute()->getGraphObject();

            // If you're not using PHP 5.5 or later, change the file reference to:
            // 'source' => '@/path/to/file.name'

            echo "Posted with id: " . $response->getProperty('id');

        } catch(\Facebook\Exceptions\FacebookRequestException $e) {

            echo "Exception occured, code: " . $e->getCode();
            echo " with message: " . $e->getMessage();

        }
    }

    public function uploadVideo(string $video)
    {
        $data = [
            'title' => 'My Foo Video',
            'description' => 'This video is full of foo and bar action.',
            'source' => $this->client->videoToUpload($video),
        ];

        try {
            $response = $this->client->post('/me/videos', $data, 'user-access-token');
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphNode = $response->getGraphNode();
        var_dump($graphNode);

        echo 'Video ID: ' . $graphNode['id'];
    }
}