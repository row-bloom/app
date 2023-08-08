<?php

namespace App\Console\Commands;

use ElaborateCode\RowBloom\Support;
use Illuminate\Console\Command;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class BloomCommand extends Command
{
    /** @var string */
    protected $signature = 'bloom';

    /** @var string */
    protected $description = 'Command description'; // TODO

    private string $templatePath;

    private array $cssPaths = [];

    private array $tablePaths = [];

    private string $interpolatorDriver;

    private string $rendererDriver;

    private array $options = [];

    public function __construct(private Support $support)
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->promptForTemplatePath();
        $this->promptForCssPaths();
        $this->promptForTablePaths();
        $this->promptForPerPage();
        $this->promptForInterpolatorDriver();
        $this->promptForRendererDriver();
        $this->promptForRendererOptions();

        // TODO: prompt for output path
        dump(
            $this->templatePath,
            $this->cssPaths,
            $this->tablePaths,
            $this->interpolatorDriver,
            $this->rendererDriver,
            $this->options
        );
    }

    private function promptForTemplatePath(): void
    {
        $this->templatePath = text(
            label: 'template path?',
            required: true,
        );
    }

    private function promptForCssPaths(): void
    {
        do {
            $path = text('Add CSS path (empty input to skip)');

            if ('' === $path) {
                break;
            }

            $this->cssPaths[] = $path;
        } while (true);
    }

    private function promptForTablePaths(): void
    {
        $this->tablePaths[] = text(
            label: 'Add table path',
            required: true,
        );

        do {
            $path = text('Add table path (empty input to skip)');

            if ('' === $path) {
                break;
            }

            $this->cssPaths[] = $path;
        } while (true);
    }

    private function promptForPerPage(): void
    {
        $this->promptForTextOption('perPage');
    }

    private function promptForInterpolatorDriver(): void
    {
        $this->interpolatorDriver = select(
            'interpolatorDriver?',
            array_keys($this->support->getInterpolatorDrivers()),
        );
    }

    private function promptForRendererDriver(): void
    {
        $this->rendererDriver = select(
            'rendererDriver?',
            array_keys($this->support->getRendererDrivers()),
        );
    }

    private function promptForRendererOptions(): void
    {
        $options = $this->support->getRendererOptionsSupport(
            $this->support->getRendererDrivers()[$this->rendererDriver]
        );

        foreach($options as $name => $supported) {
            if(!$supported) {
                continue;
            }

            $promptMethodName = 'promptFor'.ucfirst($name);
            $this->$promptMethodName();
        }
    }

    private function promptForTextOption(string $name): void
    {
        $this->options[$name] = text($name);
    }

    private function promptForBooleanOption(string $name): void
    {
        $this->options[$name] = select(
            $name,
            ['Yes' => 'y', 'No' => 'n']
        ) === 'Yes' ? true : false;
    }

    private function promptForDisplayHeaderFooter(): void
    {
        $this->promptForBooleanOption('displayHeaderFooter');
    }

    private function promptForRawHeader(): void
    {
        $this->promptForTextOption('rawHeader');
    }

    private function promptForRawFooter(): void
    {
        $this->promptForTextOption('rawFooter');
    }

    private function promptForPrintBackground(): void
    {
        $this->promptForBooleanOption('printBackground');
    }

    private function promptForPreferCSSPageSize(): void
    {
        $this->promptForBooleanOption('preferCSSPageSize');
    }

    private function promptForLandscape(): void
    {
        $this->promptForBooleanOption('landscape');
    }

    private function promptForFormat(): void
    {
        $this->promptForTextOption('format');
    }

    private function promptForWidth(): void
    {
        $this->promptForTextOption('width');
    }

    private function promptForHeight(): void
    {
        $this->promptForTextOption('height');
    }

    private function promptForMargin(): void
    {
        $this->promptForTextOption('margin');
    }

    private function promptForMetadataTitle(): void
    {
        $this->promptForTextOption('metadataTitle');
    }

    private function promptForMetadataAuthor(): void
    {
        $this->promptForTextOption('metadataAuthor');
    }

    private function promptForMetadataCreator(): void
    {
        $this->promptForTextOption('metadataCreator');
    }

    private function promptForMetadataSubject(): void
    {
        $this->promptForTextOption('metadataSubject');
    }

    private function promptForMetadataKeywords(): void
    {
        $this->promptForTextOption('metadataKeywords');
    }
}
