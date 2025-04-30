# LARAVEL

1. Instalar o composer (similar npm ou yarn)
    - composer create-project laravel/laravel .
    - laravel = projeto
    - laravel = user
    - . = pasta atual

2. Estrutura
    - /app: maior parte do app está aqui
    - /bootstrap: inicialização do app
    - /config: configurações do app
    - /database: seeders, migrations
    - /public: acesso externo
    - /resources: css, js, html
    - /routes: rotas da aplicação
    - /storage: armazenados os dados da aplicação (imagens, pdf, etc)
    - /tests: testes e2e, unit, etc
    - /vendor: todas as aplicações de terceiros
    - .env: configuração inicial da app

3. Trocar nome do banco em .env

4. Rodar a migration
    - php artisan migrate

5. Rodar app
    - php artisan serve

6. Abrir <http://127.0.0.1:8000>

7. As rotas estão em /routes/web.php

8. As views estão em /resources/views

9. Instalar extensão php intelephense (ajuda autocomplete)

10. Criar uma rota absoluta:

    ```php
        Route::get('/test', function () {
            return '<p>Olá Mundo</p>';
        });
    ```

11. Criar uma rota com parametro:

    ```php
        Route::get('/test{valor}', function ($valor) {
            return "<p>Voce enviou: {$valor}</p>";
        });
    ```

12. Criar uma view
    - Precisa usar a engine blade (=EJS), que é o sistema de template mais comum do laravel
13. Cuidar a preferência entre rotas, passar aquelas que tem paths absolutos para primeiro

14. Laravel usa o padrão MVC

15. Criar a controller
    - usa o comando: `php artisan make:controller MathController`

16. Vai aparecer novo file php em /app/http/Controllers

    ```php
        <?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;

        class MathController extends Controller

        // preciso pegar o numero de request
        {
            public function quadrado(Request $request): void {
                dd(vars: $request);
            }

            public function cubo(Request $request): void {
                
            }
        }
    ```

17. Criar a rota em /routes/web.app

    ```php
        // importtar controller
        use App\Http\Controllers\MathController;
        // ...
        // Add controller e função cb
        Route::get('/math/quadrado/{num}', [MathController::class, 'quadrado']);
    ```

18. A fn de rota vai acessar uma função específica dentro da controller e dar resposta

19. Posso passar variável diretamente a Controller

    ```php
        public function quadrado($num): int {
            return $num * $num;
        }
    ```

20. Importante integrar as views
    - Podemos usar a mesma view para cálculos distintos

21. Basta que a controller retorna a view

    ```php
        <?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;

        use Illuminate\View\View;

        class MathController extends Controller

        // preciso pegar o numero de request
        {
            public function quadrado($num): View {
                $resultado = $num ** 2;
                $op = 'Quadrado';
                // pode utilizar o compact ou array
                return view('math', [
                    'resultado' => $resultado,
                    'op' => $op,
                ]);
            }

            public function cubo($num): View {
                $resultado = $num ** 3;
                $op = 'Cubo';
                // compact
                return view('math', compact('resultado', 'op'));
            }
        }
    ```

22. Criar lista de tarefas
    - Criar table no banco com uma migration

23. Criar controller

    `php artisan make:controller TaferasController`

24. Criar tabela com migration

    `php artisan make:migration create_tarefas_table`

25. Criou a migration em app/database/migration/2025_04_24_002517_create_tarefas_table.php

    - Código original:

    ```php
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('tarefas', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('tarefas');
        }
    };

    ```

    - Adiciona um campo

    ```php
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('tarefas', function (Blueprint $table) {
                $table->id();
                $table->string('titulo');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('tarefas');
        }
    };

    ```

26. Roda a migration:

    `php artisan migrate`

27. Precisamos acessar o banco através da camada model

    - Nome maiuscula e singular em relação a tabela

    `php artisan make:model Tarefa`

    - Código gerado em app/Models/Tarefa

    ```php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Tarefa extends Model
    {
        use HasFactory;
    }

    ```

28. Adicionados um agrupamento de rotas no entorno de tarefas

    ```php
    // criamos um agrupamento de rotas
    Route::prefix('/tarefas')->group(function () {
        // barra aponta para index, a ser criado em controller
        Route::get('/', [TarefasController::class, 'index']);
    });
    ```

29. Em controller

    ```php
        <?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;

        class TaferasController extends Controller
        {
            public function index(): View {
                // cria uma pasta em views
                return view('tarefas/index');
            }
        }
    ```

30. Criar a view em app/resources/views/tarefas

    ```html
        <!DOCTYPE html>
        <html lang="pt-Br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Tarefas</title>
        </head>
        <body>
        <h1>Tarefas</h1>
            <ul>
                @foreach($tarefas as $tarefa)
                    <li>{{ $tarefa->titulo }}</li>
                @endforeach
            </ul>
        </body>
        </html>
    ```
