<?php

namespace PatientBook\Storage;

abstract class StorageController
{
    public abstract function save(): void;
    public abstract function delete(): void;
    public abstract function update(): void;
}