<?php

namespace OdinsHat\TyreLabelGenerator;


/**
 * The tyre class has all the values that represent the tyre required to build an EU standardised tyre label. This
 * object is given to the label class in order to create the tyre label.
 */
class Tyre
{
    protected $fuel;
    protected $wet;
    protected $noiseDb;
    protected $noiseClass;
    protected $validFuel;
    protected $validWet;
    protected $validNoiseClass;
    protected $validNoiseDb;

    /**
     * Constructor for building a vehicle tyre that ca be consumed by the Label class
     * for generating labels. Accepts all variables used in EU tyre labels.
     *
     * @param string $fuel       Fuel economy rating
     * @param string $wet        Wet performance rating
     * @param int    $noiseDb    Noise level in decibels
     * @param int    $noiseClass Noise classification
     */
    public function __construct(string $fuel, string $wet, int $noiseDb, int $noiseClass)
    {
        $this->validFuel = range('A', 'G');
        $this->validWet = range('A', 'G');
        $this->validNoiseDb = range(50, 100);
        $this->validNoiseClass = range(1, 3);

        $this->fuel = strtoupper($fuel);
        if (!\in_array($this->fuel, $this->validFuel, true)) {
            throw new \Exception('Invalid Fuel class given');
        }

        $this->wet = strtoupper($wet);
        if (!\in_array($this->wet, $this->validWet, true)) {
            throw new \Exception('Invalid Wet class given');
        }

        $this->noiseDb = $noiseDb;
        if (!\in_array($this->noiseDb, $this->validNoiseDb, true)) {
            throw new \Exception('Invalid noise DB level');
        }

        $this->noiseClass = $noiseClass;
        if (!\in_array($this->noiseClass, $this->validNoiseClass, true)) {
            throw new \Exception('Invalid noise class given');
        }
    }

    /**
     * Get the value of fuel.
     */
    public function getFuel(): string
    {
        return $this->fuel;
    }

    /**
     * Set the value of fuel.
     *
     * @param mixed $fuel
     *
     * @return self
     */
    public function setFuel($fuel)
    {
        $this->fuel = strtoupper($fuel);

        if (!\in_array($this->fuel, $this->validFuel, true)) {
            throw new \Exception('Invalid Fuel class given');
        }

        return $this;
    }

    /**
     * Get the value of wet.
     */
    public function getWet(): string
    {
        return $this->wet;
    }

    /**
     * Set the value of wet.
     *
     * @param mixed $wet
     *
     * @return self
     */
    public function setWet($wet)
    {
        $this->wet = strtoupper($wet);
        $valid = range('A', 'G');
        if (!\in_array($this->wet, $this->validWet, true)) {
            throw new \Exception('Invalid Wet class given');
        }

        return $this;
    }

    /**
     * Get the value of noiseDb.
     */
    public function getNoiseDb(): int
    {
        return $this->noiseDb;
    }

    /**
     * Set the value of noiseDb.
     *
     * @param mixed $noiseDb
     *
     * @return self
     */
    public function setNoiseDb($noiseDb)
    {
        $this->noiseDb = $noiseDb;
        if (!\in_array($this->noiseDb, $this->validNoiseDb, true)) {
            throw new \Exception('Invalid noise DB level');
        }

        return $this;
    }

    /**
     * Get the value of noiseClass.
     */
    public function getNoiseClass(): string
    {
        return $this->noiseClass;
    }

    /**
     * Set the value of noiseClass.
     *
     * @param mixed $noiseClass
     *
     * @return self
     */
    public function setNoiseClass($noiseClass)
    {
        $this->noiseClass = $noiseClass;
        if (!\in_array($this->noiseClass, $this->validNoiseClass, true)) {
            throw new \Exception('Invalid noise class given');
        }

        return $this;
    }
}
