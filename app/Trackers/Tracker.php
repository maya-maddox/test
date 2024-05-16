<?php

namespace App\Trackers;

use App\Trackers\Contracts\TrackerContract;

abstract class Tracker implements TrackerContract
{
    protected $raw_data;
    protected $service;
    protected $comments = [];
    protected $status = "Failed";

    /**
     * Set ingested raw_data
     *
     * @param  string $raw_data
     * @return TrackerContract
     */
    public function raw_data(string $raw_data): TrackerContract {
        $this->raw_data = $raw_data;
        return $this;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return TrackerContract
     */
    public function service(string $service): TrackerContract {
        $this->service = $service;
        return $this;
    }

    /**
     * Add comment
     *
     * @param string $comments
     * @return TrackerContract
     */
    public function comment(string $comment): TrackerContract {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * Set current status
     *
     * @param string $status
     * @return TrackerContract
     */
    public function status(string $status): TrackerContract {
        $this->status = $status;
        return $this;
    }


    /**
     * Return self if active, or null
     *
     * @return TrackerContract|null
     */
    public function active(): ?TrackerContract {
        if ($this->raw_data) { return $this; }
        if ($this->service) { return $this; }
        if ($this->comments != []) { return $this; }
        return null;
    }


    /**
     * Save tracking to database.
     *
     * @return mixed
     */
    abstract public function save();

}
