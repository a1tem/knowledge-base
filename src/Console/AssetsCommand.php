<?php

namespace A1tem\Knowledgebase\Console;

use Illuminate\Console\Command;

class AssetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'knowledge-base:assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-publish the knowledge-base assets';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'knowledge-base.vue-components',
            '--force' => true,
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'knowledge-base.views',
            '--force' => true,
        ]);
    }
}
