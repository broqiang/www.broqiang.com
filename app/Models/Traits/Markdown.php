<?php 
namespace App\Models\Traits;

use BroQiang\LaravelMarkdown\Markdown as BroQiangMarkdown;

trait Markdown
{
    public function convertMarkdownToHtml(string $field)
    {
        if(! $this->$field) {
            return $this;
        }

        $this->$field = (new BroQiangMarkdown())->convertMarkdownToHtml($this->$field);

        return $this;
    }

    public function stringToMarkdown(string $field)
    {
        return (new BroQiangMarkdown())->convertMarkdownToHtml($field);
    }
}