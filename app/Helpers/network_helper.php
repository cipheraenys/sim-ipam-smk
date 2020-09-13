<?php


if (! function_exists('is_valid_ipv4'))
{
    function is_valid_ipv4(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }
}

if (! function_exists('cidr_to_netmask'))
{
    function cidr_to_netmask(int $prefix): string
    {
        $mask = $prefix === 0 ? 0 : (-1 << (32 - $prefix)) & 0xFFFFFFFF;

        return long2ip($mask);
    }
}

if (! function_exists('calculate_subnet'))
{
    function calculate_subnet(string $ip, int $prefix): ?array
    {
        if (! is_valid_ipv4($ip) || $prefix < 8 || $prefix > 30) {
            return null;
        }

        $ipLong  = ip2long($ip);
        $mask    = (-1 << (32 - $prefix)) & 0xFFFFFFFF;
        $network = $ipLong & $mask;
        $bcast   = ($network | (~$mask & 0xFFFFFFFF)) & 0xFFFFFFFF;

        return [
            'ip'          => $ip,
            'prefix'      => $prefix,
            'netmask'     => long2ip($mask),
            'wildcard'    => long2ip(~$mask & 0xFFFFFFFF),
            'network'     => long2ip($network),
            'broadcast'   => long2ip($bcast),
            'first_host'  => long2ip($network + 1),
            'last_host'   => long2ip($bcast - 1),
            'total_hosts' => pow(2, 32 - $prefix) - 2,
        ];
    }
}