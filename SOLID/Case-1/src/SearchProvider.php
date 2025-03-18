<?php
interface SearchProvider
{
    public function search(string $keyword): array;
}
