<?php


namespace Service\SocialNetwork;


interface SocialNetworkInterface
{
    public function uploadPhoto(string $photo);

    public function uploadVideo(string $video);
}