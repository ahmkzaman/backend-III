<?php
abstract class MediaFile
{
    protected string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }
    public function play(): string
    {
        return "Playing" . $this->fileName;
    }
    public function pause(): string
    {
        return "Paused" . $this->fileName;
    }
    public function stop(): string
    {
        return "Stopped" . $this->fileName;
    }

    abstract public function getMediaType(): string;
}

class AudioFile extends MediaFile
{
    public function getMediaType(): string
    {
        return "Audio";
    }
    public function play(): string
    {
        return "Playing audio" . $this->fileName;
    }
}

class VideoFile extends MediaFile
{

    public function getMediaType(): string
    {
        return "Video";
    }

    public function play(): string
    {
        return "Playing video" . $this->fileName;
    }

    public function subtitle(): string
    {
        return "Subtitle for" . $this->fileName;
    }
}

class MediaPlayer
{
    private MediaFile $mediaFile;
    public function setMediaFile(MediaFile $mediaFile): void
    {
        $this->mediaFile = $mediaFile;
    }
    public function play(): string
    {
        return $this->mediaFile->play();
    }
    public function pause(): string
    {
        return $this->mediaFile->pause();
    }
    public function stop(): string
    {
        return $this->mediaFile->stop();
    }
    public function enableSubtitle(): string
    {
        if ($this->mediaFile instanceof VideoFile) {
            return $this->mediaFile->subtitle();
        }
        return "Subtitle is not available for this media file.";
    }
}

$audio = new AudioFile("song.mp3");
$video = new VideoFile("movie.mp4");

$player = new MediaPlayer();
$player->setMediaFile($audio);
echo $player->play() . "\n";
echo $player->pause() . "\n";
echo $player->stop() . "\n";
echo $player->enableSubtitle() . "\n";
$player->setMediaFile($video);
echo $player->play() . "\n";
echo $player->pause() . "\n";
echo $player->stop() . "\n";
echo $player->enableSubtitle() . "\n";
