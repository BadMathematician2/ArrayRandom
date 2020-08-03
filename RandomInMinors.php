<?php


namespace App\Packages\ArrayRandom;


class RandomInMinors
{
    /**
     * @param array[] $array
     * @param int $minors_size
     * @return array
     */
    public function buildMinors($array, $minors_size)
    {
        $rows = count($array);

        $columns = count($array[array_key_first($array)]);

        $minors = [];  // масив із усіма мінорами
        $minors_number = 0;

        //проходимось по всім рядкам і стовпчикам ( за один крок ми беремо мінор заданої кількості, тому крок у нас minors_size )
        for ($i = 1; $i <= $rows; $i += $minors_size) {
            for ($j = 1; $j <= $columns; $j += $minors_size) {

                // заповнюємо мінор, якщо try видає помилку, то це означає, що такого елемента немає, тобто ми вийшли з край
                //minors_number - номер мінора, причому ми проходимо спочатку по рядках, тобто спочатку всі можливі мінори із першим рядком
                for ($k = 0; $k < $minors_size; $k++) {
                    for ($l = 0; $l < $minors_size; $l++) {
                        try {
                            $minors[$minors_number][$k][$l] = $array[$i + $k][$j + $l];
                        }catch (\Exception $e){
                            $minors[$minors_number][$k][$l] = null;
                        }
                    }
                }

                $minors_number++;
            }

        }

        return $minors;
    }

    /**
     * @param array $minors
     * @param int $rows
     * @param int $columns
     * @return array[]
     */
    private function buildArrayByMinors($minors, $rows, $columns)
    {
        $array = [[]];
        $minors_size = count($minors[0]);
        $minors_number = 0;

        for ($i = 1; $i <= $rows; $i += $minors_size) {
            for ($j = 1; $j <= $columns; $j += $minors_size) {

                for ($k = 0; $k < $minors_size; $k++) {
                    for ($l = 0; $l < $minors_size; $l++) {
                        try {
                            $array[$i + $k][$j + $l] = $minors[$minors_number][$k][$l];
                        }catch (\Exception $e) {}
                    }
                }
                $minors_number++;
            }
        }
        unset($array[0]);

        return $array;
    }

    /**
     * @param array $minors
     * @return mixed
     */
    private function buildNewMinors($minors)
    {
        $minor_size = count($minors[0]);
        foreach ($minors as $key => $minor) {
            $arr = [];
            for ($i = 0; $i < $minor_size; $i++) {
                for ($j = 0; $j < $minor_size; $j++) {
                    $arr[] = $minor[$i][$j];
                }
            }
            shuffle($arr);
            $k = 0;
            for ($i = 0; $i < $minor_size; $i++) {
                for ($j = 0; $j < $minor_size; $j++) {
                    $minors[$key][$i][$j] = $arr[$k];
                    $k++;
                }
            }
        }

        return $minors;
    }

    /**
     * @param array[] $array
     * @param int $minors_size
     * @return array[]
     */
    public function buildNew($array, $minors_size)
    {
        $rows = count($array);
        $columns = count(($array[array_key_first($array)]));

        $minors = $this->buildMinors($array, $minors_size);

        $minors = $this->buildNewMinors($minors);

        return $this->buildArrayByMinors($minors, $rows, $columns);
    }

}
