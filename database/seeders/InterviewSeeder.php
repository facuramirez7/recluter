<?php

namespace Database\Seeders;

use App\Models\Interview;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interview::create([
            'position' => 'PHP Developer',
            'description' => 'Somos una consultora de Servicios IT con más de 14 años de experiencia en el mercado. Acompañamos a empresas líderes del mundo a conseguir soluciones de negocios a través de la innovación tecnológica. Asentados en la transformación Digital y Cultural ofrecemos nuestros servicios 100% remotos desde Argentina para el mundo. Te comparto nuestra web para que puedas conocernos un poco más: https://rh-t.com/es/inicio/
            Actualmente nos encontramos en búsqueda de un Desarrollador PHP/Magento Semi Senior / Senior 
            📍 BUENOS AIRES, ARGENTINA.
            👩🏻‍💻 Esquema Híbrido (Se asiste a las oficinas por reuniones esporádicas 1 vez cada 15 días)',
            'user_id' => 2,
            'company_id' => 1,
            'time_to_think' => 12,
            'time_to_reply' => 12,
            'goodbye' => 'Gracias por responder el cuestionario! Cualquier novedad te la comunicaremos.',
        ]);

        Question::create([
            'question' => 'Cuéntanos un poco de tí.',
            'interview_id' => 1,
            'video' => 1,
        ]);
        Question::create([
            'question' => '¿Tienes experiencia en PHP? Nombre los frameworks que ha utilizado.',
            'interview_id' => 1,
            'video' => 1
        ]);
        Question::create([
            'question' => '¿Sabes lo que es PHP Unit?',
            'interview_id' => 1,
            'video' => 0
        ]);
        Question::create([
            'question' => '¿Qué otros lenguajes conoces?',
            'interview_id' => 1,
            'video' => 0
        ]);
        Question::create([
            'question' => '¿Tienes estudios?',
            'interview_id' => 1,
            'video' => 0
        ]);

        Interview::create([
            'position' => 'Solution Sales',
            'description' => '🚀¿Querés formar parte de la transformación digital y ser parte de proyectos desafiantes e innovadores?
            💻 Nuestro equipo de Cloud Operations es responsable de los aspectos técnicos de la entrega e implementación de soluciones, hasta el éxito de las operaciones en vivo.
            Buscamos profesionales que quieran acompañarnos en la realización y el mantenimiento de las operaciones, implementando soluciones de alojamiento escalables y de alto rendimiento utilizando tecnologías de nube pública y privada.',
            'user_id' => 3,
            'company_id' => 2,
            'time_to_think' => 12,
            'time_to_reply' => 120,
            'goodbye' => 'Muchas Gracias! Te comunicaermos a la brevedad cualquier novedad acerca de tu aplicación.',
        ]);

        Question::create([
            'question' => '¿Tenés experiencia en el rubro?',
            'interview_id' => 2,
            'video' => 0,
        ]);
        Question::create([
            'question' => 'Vendeme un lápiz.',
            'interview_id' => 2,
            'video' => 1
        ]);
        Question::create([
            'question' => '¿Qué es la oferta y demanda?',
            'interview_id' => 2,
            'video' => 1
        ]);
        Question::create([
            'question' => 'Remuneración pretendida:',
            'interview_id' => 2,
            'video' => 0
        ]);
        Question::create([
            'question' => '¿Por qué deberíamos contratarte?',
            'interview_id' => 2,
            'video' => 1
        ]);
    }
}
