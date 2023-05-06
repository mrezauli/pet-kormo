<!doctype html>
<html lang="en">

<head>
    <title>Photo Template</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px dashed black;
            text-align: center;
            padding: 10px;
        }

        .norm {
            width: 4cm;
            height: 5cm;
        }
    </style>
</head>

<body>
    <table>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    @for ($j = 0; $j < 4; $j++)
                        <td><img src="{{ asset($src) }}" alt="NA" class='norm'></td>
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
</body>

</html>
