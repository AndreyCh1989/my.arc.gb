<?php


namespace Service\SocialNetwork;


use VK\Client\VKApiClient;

class VK implements SocialNetworkInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new VKApiClient();
    }

    public function uploadPhoto(string $photo)
    {
        $address = $this->client->photos()->getMessagesUploadServer('{access_token}');
        $photo = $this->client->getRequest()->upload($address['upload_url'], 'photo', $photo);
        $response_save_photo = $this->client->photos()->saveMessagesPhoto($access_token, array(
            'server' => $photo['server'],
            'photo' => $photo['photo'],
            'hash' => $photo['hash'],
        ));
    }

    public function uploadVideo(string $video)
    {
        $address = $this->client->video()->save($access_token, array(
            'name' => 'My video',
        ));
        $video = $this->client->getRequest()->upload($address['upload_url'], 'video_file', $video);
    }
}