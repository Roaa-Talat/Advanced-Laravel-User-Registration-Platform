<?php
if (isset($_POST['birthdate'])) {
    $birthdate = $_POST["birthdate"];
    $birth_day = date('d', strtotime($birthdate));
    $birth_month = date('m', strtotime($birthdate));
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb188.p.rapidapi.com/api/v1/getBornOn?month=$birth_month&day=$birth_day",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: imdb188.p.rapidapi.com",
            "X-RapidAPI-Key: fdf00fecd8mshd9dc1dd4a1930b9p1dea8bjsn54f59102e9b9"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $data = json_decode($response, true);
        echo "<h3>Actors Born on $birthdate</h3>";
        echo "<ul>";
        foreach ($data['data']['list'] as $item) {
            $name = $item['nameText']['text'];

            $names_list = '<ul>';
            $names_list .= '<li>' . $name . '</li>';
            $names_list .= '</ul>';

            echo $names_list;
        }
    }
}