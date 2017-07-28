<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Handtekeningen petitie {{ $signatures->title }}</title>

        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                text-align: center;
            }

            th, td {
                padding-left: 5px;
                padding-right: 5px;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Woonplaats:</th>
                    <th>Email</th>
                    <th>Getekend op:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($signatures->signatures as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->name }}</td>
                        <td>
                            {{ $record->postal_code }}
                            {{ ucfirst($record->city) }},
                            {{ $record->country->long_name }}
                        </td>
                        <td>{{ $record->email }}</td>
                        <td>{{ $record->created_at }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="5">Test</td>
                    </tr>
            </tbody>
        </table>
    </body>
</html>
