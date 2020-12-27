<?php

namespace OdinsHat\TyreLabelGenerator;

/**
 * Undocumented class
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
     * @param string  $fuel         Fuel economy rating
     * @param string  $wet          Wet performance rating
     * @param integer $noiseDb      Noise level in decibels
     * @param integer $noiseClass   Noise classification
     */
    public function __construct(string $fuel, string $wet, int $noiseDb, int $noiseClass)
    {
        $this->validFuel = range('A', 'G');
        $this->validWet = range('A', 'G');
        $this->validNoiseDb = range(50, 100);
        $this->validNoiseClass = range(1,3);

        $this->fuel = strtoupper($fuel);
        if (!in_array($this->fuel, $this->validFuel)) {
            throw new \Exception('Invalid Fuel class given');
        }

        $this->wet = strtoupper($wet);
        if (!in_array($this->wet, $this->validWet)) {
            throw new \Exception('Invalid Wet class given');
        }

        $this->noiseDb = $noiseDb;
        if (!in_array($this->noiseDb, $this->validNoiseDb)) {
            throw new \Exception('Invalid noise DB level');
        }

        $this->noiseClass = $noiseClass;
        if (!in_array($this->noiseClass, $this->validNoiseClass)) {
            throw new \Exception('Invalid noise class given');
        }
    }

    /**
     * Get the value of fuel
     *
     * @return string
     */ 
    public function getFuel(): string
    {
        return $this->fuel;
    }

    /**
     * Set the value of fuel
     *
     * @return  self
     */ 
    public function setFuel($fuel)
    {
        $this->fuel = strtoupper($fuel);

        if (!in_array($this->fuel, $this->validFuel)) {
            throw new \Exception('Invalid Fuel class given');
        }

        return $this;
    }

    /**
     * Get the value of wet
     *
     * @return string
     */ 
    public function getWet(): string
    {
        return $this->wet;
    }

    /**
     * Set the value of wet
     *
     * @return  self
     */ 
    public function setWet($wet)
    {
        $this->wet = strtoupper($wet);
        $valid = range('A', 'G');
        if (!in_array($this->wet, $this->validWet)){
            throw new \Exception('Invalid Wet class given');
        }

        return $this;
    }

    /**
     * Get the value of noiseDb
     *
     * @return int
     */ 
    public function getNoiseDb(): int
    {
        return $this->noiseDb;
    }

    /**
     * Set the value of noiseDb
     *
     * @return  self
     */ 
    public function setNoiseDb($noiseDb)
    {
        $this->noiseDb = $noiseDb;
        if (!in_array($this->noiseDb, $this->validNoiseDb)) {
            throw new \Exception('Invalid noise DB level');
        }

        return $this;
    }

    /**
     * Get the value of noiseClass
     *
     * @return string
     */ 
    public function getNoiseClass(): string
    {
        return $this->noiseClass;
    }

    /**
     * Set the value of noiseClass
     *
     * @return  self
     */ 
    public function setNoiseClass($noiseClass)
    {
        $this->noiseClass = $noiseClass;
        if (!in_array($this->noiseClass, $this->validNoiseClass)) {
            throw new \Exception('Invalid noise class given');
        }

        return $this;
    }
}
