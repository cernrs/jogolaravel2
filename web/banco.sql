public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cel');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }



public function up()
    {
        Schema::create('etapas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->boolean('inscricoes_abertas');
            $table->integer('etapa')->nullable();;
        });
    }

public function up()
    {
        Schema::create('duplas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jogador1_id')->unsigned();
            $table->integer('jogador2_id')->unsigned();
            $table->integer('etapa_id')->unsigned();
            
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade'); 
            $table->foreign('jogador2_id')->references('id')->on('users')->onDelete('cascade');  
            $table->foreign('jogador1_id')->references('id')->on('users')->onDelete('cascade');  

        });
    }


    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('chave', 1);
            $table->integer('posicao')->unsigned();
            $table->integer('dupla_id')->unsigned();
            $table->integer('etapa_id')->unsigned();
            
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade'); 
            $table->foreign('dupla_id')->references('id')->on('duplas')->onDelete('cascade');  
            
        });
    }


    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dupla1_id')->unsigned();
            $table->integer('dupla2_id')->unsigned();
            $table->integer('etapa_id')->unsigned();
            $table->char('tipo', 1);
            $table->timestamps();
            
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade'); 
            $table->foreign('dupla2_id')->references('id')->on('duplas')->onDelete('cascade');  
            $table->foreign('dupla1_id')->references('id')->on('duplas')->onDelete('cascade');  

        });
    }


    public function up()
    {
        Schema::create('partidas_resultados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partida_id')->unsigned();
            $table->integer('dupla_id')->unsigned();
            $table->integer('pontos')->unsigned();
            $table->integer('vitoria')->unsigned();
            $table->integer('derrota')->unsigned();
            $table->timestamps();
            
            $table->foreign('dupla_id')->references('id')->on('duplas')->onDelete('cascade');  
            $table->foreign('partida_id')->references('id')->on('partidas')->onDelete('cascade');  

        });
    }


    public function up()
    {
        Schema::create('users_pontuacao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('pontos');
            $table->integer('etapa_id')->unsigned();
            
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  

        });
    }
