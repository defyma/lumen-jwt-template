<?php

namespace App\Helpers;

class Helpers
{
    /**
     * @param $data
     */
    public static function dump($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    /**
     * @param $datetime
     * @param bool $removeJam
     * @param bool $bulanInd
     * @param string $delimiterTgl
     * @return string|null
     */
    public static function changeDateTimeFormat($datetime, $removeJam = false, $bulanInd = false, $delimiterTgl = "-")
    {
        if (!is_null($datetime) || !empty($datetime)) {
            $arrDT = explode(" ", $datetime);
            return $removeJam
                ? self::changeDateFormat($arrDT[0], $bulanInd, $delimiterTgl)
                : implode(" ", [
                    self::changeDateFormat($arrDT[0], $bulanInd, $delimiterTgl),
                    $arrDT[1]
                ]);
        }

        return null;
    }

    /**
     * @param $date
     * @param bool $bulanIndo
     * @param string $delimiter
     * @return string|null
     */
    public static function changeDateFormat($date, $bulanIndo = false, $delimiter = '-')
    {
        if (!is_null($date) || !empty($date)) {
            return null;
        }

        $arrDate = explode('-', $date);
        if (count($arrDate) > 2) {
            $bulan = $arrDate[1];
            if ($bulanIndo) {
                $bulan = self::namaBulan($bulan);
                if ($delimiter == "-") $delimiter = " ";
            }

            return implode($delimiter, [
                $arrDate[2], $bulan, $arrDate[0]
            ]);
        }

        return null;
    }

    /**
     * @param int $angka_bulan
     * @return string
     */
    public static function namaBulan($angka_bulan = 0)
    {
        switch ((int)$angka_bulan) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
            default:
                return "-";
                break;
        }
    }

    /**
     * @param $jenis
     * @return string
     */
    public static function jenisKelamin($jenis)
    {
        return (strtolower($jenis) == "l") ? "Laki-Laki" : "Perempuan";
    }

    /**
     * @param $number
     * @return string
     */
    public static function romawi($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    /**
     * @param int $length
     * @param string $type
     * @return string
     */
    public static function generateRandomString($length = 10, $type = 'alphaNumeric')
    {
        $characters = '';

        switch ($type) {
            case 'alphaNumeric':
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'numeric':
                $characters = '0123456789';
                break;
            case 'lowerAlpha':
                $characters = 'abcdefghijklmnopqrstuvwxyz';
                break;
            case 'upperAlpha':
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'lowerAlphaNumeric':
                $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
                break;
            case 'upperAlphaNumeric':
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                break;
        }

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param $bytes
     * @param int $decimals
     * @return string
     */
    public static function filesize($bytes, $decimals = 2)
    {
        $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        /** @var int $factor */
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . " " . @$size[$factor];
    }

    /**
     * @return mixed|string
     */
    public static function getClientIP()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
}
