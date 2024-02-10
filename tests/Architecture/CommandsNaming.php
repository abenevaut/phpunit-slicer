<?php

namespace Tests\Architecture;

use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class CommandsNaming extends BaseRule implements RuleContract
{
    /**
     * Define your architectural rule
     *
     * @link https://github.com/phparkitect/arkitect
     *
     * @return \Arkitect\Rules\DSL\ArchRule
     */
    public static function rule(): ArchRule
    {
        return Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Commands'))
            ->should(new HaveNameMatching('*Command'))
            ->because('It\'s a laravel-one naming convention');
    }

    /**
     * Define the path related to your rule
     *
     * @example app/Http/Controllers
     *
     * @return string
     */
    public static function path(): string
    {
        return 'app/Commands';
    }
}
