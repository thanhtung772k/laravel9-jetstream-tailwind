<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimesheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrCheckIn = ['07:47:00', '08:14:00'];
        $arrCheckOut = ['10:28:00', '18:09:00'];
        $checkIn = $arrCheckIn[rand(0, 1)];
        $checkOut = $arrCheckOut[rand(0, 1)];

        $checkInFullDay = now()->parse(now()->format('Y-m-d ' . $checkIn));
        $checkOutFullDay = now()->parse(now()->format('Y-m-d ' . $checkOut));
        //Tính ngày công thực tế
        $sub = $checkOutFullDay->diffInSeconds($checkInFullDay);
        //Hàm gmdate() để định dạng vs tham số truyền vào là giây
        $actualWorkingTime = gmdate("H:i:s", $sub);
        //Tách checkin và checkout để lấy từng phần tử giờ và phút
        $in = explode(":", $checkIn);
        $sumIn = $in[0] * 3600 + $in[1] * 60;
        $out = explode(":", $checkOut);
        $sumOut = $out[0] * 3600 + $out[1] * 60;
        //Gán ngày công thực tế vào biến $sum- biến tính công
        $sum = $sub;
        //Nếu Về sau 12h thì $sum trừ cho 90p giờ nghỉ trưa
        if ((12 * 3600 - $sumOut) < 0)
            $sum = $sub - 90 * 60;
        //Nếu đến trước 8h thì công cũng chỉ bằng công thực tế - 8h
        if ((8 * 3600 - $sumIn) > 0) {
            $sum = $sumOut - 8 * 3600;
        }
        //Biến tính công chỉ tính 8h là max
        if ($sum >= 480 * 60)
            $sum = 480 * 60;
        $paidWorkingTime = gmdate("H:i:s", $sum);
        $note = "";
        //Nếu
        if ($sum != 8 * 3600) {
            $sumNote = 8 * 3600 - $sum;
            $note = 'Về sớm: ' . gmdate("H:i:s", $sumNote);
        } else
            $note = "-";
        return [
            'date' => $this->faker->date('Y-m-d'),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'actual_working_time' => $actualWorkingTime,
            'paid_working_time' => $paidWorkingTime,
            'note' => $note,
            'user_id' => $this->faker->randomDigitNot(5),
        ];
    }
}
