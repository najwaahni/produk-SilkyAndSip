<?php

namespace App\Database;

use Illuminate\Database\Connectors\PostgresConnector;
use InvalidArgumentException;

class NeonPostgresConnector extends PostgresConnector
{
    protected function addServerOptions($dsn, array $config)
    {
        $dsn = parent::addServerOptions($dsn, $config);
        $endpoint = $config['endpoint'] ?? null;

        if ($endpoint === null || $endpoint === '') {
            return $dsn;
        }

        if (! preg_match('/\Aep-[A-Za-z0-9-]+\z/', $endpoint)) {
            throw new InvalidArgumentException('The Neon endpoint ID is invalid.');
        }

        return $dsn.";options=endpoint={$endpoint}";
    }
}
