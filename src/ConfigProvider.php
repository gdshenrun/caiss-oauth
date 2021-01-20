<?php

namespace OAuthServer;

use League\OAuth2\Server\ResourceServer;
use OAuthServer\Command\OAuthKeyCommand;
use OAuthServer\AuthorizationServerFactory;
use League\OAuth2\Server\AuthorizationServer;
use OAuthServer\Repositories\TokenRepository;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                AuthorizationServer::class => AuthorizationServerFactory::class,
                ResourceServer::class => ResourceServerFactory::class,
                
                // make repository oauth
                AccessTokenRepository::class => AccessTokenRepository::class,
                AuthCodeRepository::class => AuthCodeRepository::class,
                ClientRepository::class => ClientRepository::class,
                RefreshTokenRepository::class => RefreshTokenRepository::class,
                ScopeRepository::class => ScopeRepository::class,
                UserRepository::class => UserRepository::class,
                TokenRepository::class => TokenRepository::class,
            ],
            'listeners' => [
                //
            ],
            'commands' => [
                OAuthKeyCommand::class
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                    'collectors' => [
                        // 
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for oauth.',
                    'source' => __DIR__ . '/../publish/oauth.php',
                    'destination' => BASE_PATH . '/config/autoload/oauth.php',
                ],
                [
                    'id' => 'migration',
                    'description' => 'The migration for oauth.',
                    'source' => __DIR__ . '/../migrations',
                    'destination' => BASE_PATH . '/migrations',
                ],
            ],
        ];
    }
}