<?php

namespace App\Trackers\Contracts;

interface TrackerContract
{
    /**
     * Set ingested raw_data
     *
     * @param  string $raw_data
     * @return TrackerContract
     */
    public function raw_data(string $raw_data): TrackerContract;

    /**
     * Set service
     *
     * @param string $service
     * @return TrackerContract
     */
    public function service(string $service): TrackerContract;

    /**
     * Add comment
     *
     * @param string $comments
     * @return TrackerContract
     */
    public function comment(string $comment): TrackerContract;

    /**
     * Set current status
     *
     * @param string $status
     * @return TrackerContract
     */
    public function status(string $status): TrackerContract;


    /**
     * Return self if active, or null
     *
     * @return TrackerContract|null
     */
    public function active(): ?TrackerContract;

    /**
     * Save tracking to database.
     *
     * @return mixed
     */
    public function save();

}
