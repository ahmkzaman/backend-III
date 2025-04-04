<?php

// This code demonstrates the Strategy Pattern.
interface DocumentConversionStrategy
{
    public function convert(Document $document);
}

// The Document class represents a document with a name, content, and format.
class Document
{
    private string $name;
    private string $content;
    private string $format;
    public function __construct(string $name, string $content, string $format)
    {
        $this->name = $name;
        $this->content = $content;
        $this->format = $format;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function getFormat(): string
    {
        return $this->format;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    public function setFormat(string $format): void
    {
        $this->format = $format;
    }
}

class PDFConversionStrategy implements DocumentConversionStrategy
{
    public function convert(Document $document)
    {
        // Convert to PDF
        return "Converted to PDF: " . $document->getContent();
    }
}

class WordConversionStrategy implements DocumentConversionStrategy
{
    public function convert(Document $document)
    {
        // Convert to Word
        return "Converted to Word: " . $document->getContent();
    }
}
//DocumentConverter class uses a conversion strategy to convert documents.


class DocumentConverter
{
    private DocumentConversionStrategy $convertStrategy;

    public function __construct(DocumentConversionStrategy $convertStrategy)
    {
        $this->convertStrategy = $convertStrategy;
    }
    public function convert(Document $document)
    {
        return $this->convertStrategy->convert($document);
    }
}

$document = new Document("My docu", "This is the content.", "PDF");
$converter = new DocumentConverter(new PDFConversionStrategy());
echo $document->getName() . " " . $converter->convert($document) .  PHP_EOL;
