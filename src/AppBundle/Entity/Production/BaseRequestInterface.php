<?php

namespace AppBundle\Entity\Production;

interface BaseRequestInterface
{
    public function getInputSamples();

    public function setInputSamples($inputSamples);

    public function getOutputSamples();

    public function setOutputSamples($outputSamples);
}
