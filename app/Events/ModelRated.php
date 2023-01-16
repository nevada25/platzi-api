<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelRated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Model $qualifier;
    private Model $rateable;
    private float $score;

    public function __construct(Model $qualifier, Model $rateable, float $score)
    {

        $this->qualifier = $qualifier;
        $this->rateable = $rateable;
        $this->score = $score;
    }

    /**
     * @return Model
     */
    public function getQualifier(): Model
    {
        return $this->qualifier;
    }

    /**
     * @return Model
     */
    public function getRateable(): Model
    {
        return $this->rateable;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }





}
