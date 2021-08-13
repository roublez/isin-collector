<?php

namespace Roublez\Isin\Commands;

use Roublez\Isin\Core\Command;

class StorageClear extends Command {

    /**
     * The command signature
     *
     * @var string
     */
    protected string $signature = 'storage:clear';

    /**
     * The command description
     *
     * @var string
     */
    protected string $description = 'Clears the storage folder';

    /**
     * The handle method
     *
     * @return void
     */
    public function handle () : int {
        collect(glob(path('storage', '**')))->each(fn (string $directory) => $this->removeDirectory($directory));

        return self::SUCCESS;
    }

    private function removeDirectory (string $directory) {
        $contents = array_diff(scandir($directory), [ '.', '..', '.gitignore' ]);

        foreach ($contents as $file) {
            $absolute = $directory.DIRECTORY_SEPARATOR.$file;
            is_dir($absolute)
                ? $this->removeDirectory($absolute)
                : unlink($absolute);
        }

        rmdir($directory);
    }
}
