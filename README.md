# base_client_api

Instalacja:
1. Wgrywamy pliki do folderu z projektami
2. Wskazujemy w virtualHost na nasz folder public np. /var/www/base_client_api/public
3. Jesli to potrzeba dodajemyu naszą nazwę serwera w pliku hosts

Testowanie PHPStorm:
1. Jesli używamy PHPStorm to usuwamy z końca nazwy pliku .dist np: tests/http-client.private.env.json
2. W pliku tests/http-client.private.env.json parametr host ustawiamy swój który podalismy jako virtualHost np: api-client.local
3. Testować możemy za pomocą PHPStorm w pliku tests/rest_request.http wybierając profil 'development', 

Dostepne endpointy:
1. /api/list - get
2. /api/new - post (dane wejściowe: firstname, surname)
3. /api/edit/id - post (id - identyfikator w bazie danych np: 2, dane wejściowe: firstname, surname
4. /api/delete/id - post (id - identyfikator w bazie danych np: 2)

