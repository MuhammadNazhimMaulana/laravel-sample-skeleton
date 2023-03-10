<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Repository';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Repositories';
    
    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $this->createInterface();

        $stub = parent::replaceClass($stub, $name);

        // Prepare Interface Name
        $interfaceName = str_replace('Repository', '', $this->argument('name'));
        
        // Array For Name
        $repoName = explode('/', $this->argument('name'));

        // Change Path Name
        $stub = str_replace('DummyPath', str_replace('/', '\\', $interfaceName).'Interface', $stub);
        
        // Change Interface Name
        $stub = str_replace('DummyInterface', str_replace('Repository', '', $repoName[count($repoName)-1].'Interface'), $stub);

        // Change Repositoy Name
        $stub =  str_replace('DummyRepository', $repoName[count($repoName)-1], $stub);

        // Deleting One
        array_pop($repoName);

        return str_replace('DummyRepositoriesPath', $repoName ? 'Repositories\\'.implode('/', $repoName).';' : 'Repositories;', $stub);
    }

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return  app_path() . '/Console/Commands/Stubs/repository.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Repositories';
	}

    /**
     * Create a interface.
     *
     * @return void
     */
    protected function createInterface()
    {
        $interfaceName = str_replace('Repository', '', $this->argument('name'));

        $this->call('make:interface', [
            'name' => $interfaceName.'Interface',
        ]);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository.'],
        ];
    }
}
