$('#quiz').quiz({
    //resultsScreen: '#results-screen',
    //counter: false,
    //homeButton: '#custom-home',
    counterFormat: 'Pregunta %current de %total',
    questions: [
      {
        'q': '¿Cuál de los siguientes filósofos griegos es conocido por su teoría de las ideas o formas, en la que afirmaba que el mundo material es una mera copia imperfecta de realidades eternas?',
        'options': [
          'Sócrates',
          'Aristoteles',
          'Platón',
          'Epicuro'
        ],
        'correctIndex': 2,
        'correctResponse': '¡Excelente! La respuesta correcta es c) Platón. Platón creía en las Ideas o Formas como entidades eternas y perfectas que subyacen al mundo material.',
        'incorrectResponse': 'Incorrecto. La respuesta correcta es c) Platón. Platón es famoso por su teoría de las Ideas o Formas.'
      },
      {
        'q': '¿Cuál es el proceso biológico por el cual las plantas convierten la luz solar en energía química para su crecimiento?',
        'options': [
          'Fotosíntesis',
          'Respiración celular',
          'Fermentación',
          'Mitosis'
        ],
        'correctIndex': 0,
        'correctResponse': '¡Muy bien! La respuesta correcta es a) Fotosíntesis. Este proceso permite a las plantas convertir la luz solar en energía química.',
        'incorrectResponse': 'Incorrecto. La respuesta correcta es a) Fotosíntesis, que es el proceso mediante el cual las plantas convierten la luz solar en energía química.'
      },
      {
        'q': '¿Quién fue el primer presidente de los Estados Unidos?',
        'options': [
          'Thomas Jefferson',
          'Benjamin Franklin',
          'George Washington',
          'John Adams'
        ],
        'correctIndex': 2,
        'correctResponse': 'Correcto. El primer presidente de los Estados Unidos fue c) George Washington, quien asumió el cargo en 1789.',
        'incorrectResponse': 'No es la respuesta correcta. El primer presidente de los Estados Unidos fue c) George Washington.'
      },
      {
        'q': '¿Cuál es el concepto económico que se refiere a la medida en que un bien o servicio satisface las necesidades y deseos de las personas, y que es la base para asignar valor en una economía de mercado?',
        'options': [
          'Elasticidad',
          'Utilidad',
          'Inflación',
          'Oferta y demanda'
        ],
        'correctIndex': 1,
        'correctResponse': 'Muy bien, la respuesta correcta es b) Utilidad. En economía, la utilidad se refiere a la satisfacción o valor que un bien o servicio proporciona a las personas.',
        'incorrectResponse': 'Incorrecto. La respuesta correcta es b) Utilidad. La utilidad es fundamental en la economía de mercado para determinar el valor de los bienes y servicios.'
      },
      {
        'q': '¿Cuál es el proceso químico por el cual dos átomos de hidrógeno se combinan con uno de oxígeno para formar una molécula de agua?',
        'options': [
          'Descomposición',
          'Oxidación',
          'Combustión',
          'Hidrólisis'
        ],
        'correctIndex': 0,
        'correctResponse': '¡Correcto! El proceso químico es a) Descomposición, en el que dos átomos de hidrógeno se combinan con uno de oxígeno para formar una molécula de agua.',
        'incorrectResponse': 'Incorrecto. La respuesta correcta es a) Descomposición, que describe el proceso de formación del agua a partir de hidrógeno y oxígeno.'
      },
      {
        'q': '¿Cuál de los siguientes elementos químicos es un noble gas que se encuentra en menor cantidad en la atmósfera terrestre y se utiliza comúnmente en lámparas de neón?',
        'options': [
          'Helio',
          'Kriptón',
          'Argón',
          'Xenón'
        ],
        'correctIndex': 3,
        'correctResponse': '¡Correcto! La respuesta correcta es d) Xenón. El xenón es un noble gas que se utiliza en lámparas de neón y otros dispositivos luminosos.',
        'incorrectResponse': 'No es la respuesta correcta. La respuesta correcta es d) Xenón, un noble gas utilizado en lámparas de neón.'
      },
      {
        'q': 'En la novela "Cien años de soledad" de Gabriel García Márquez, ¿cuál es el nombre de la ciudad ficticia en la que se desarrolla la mayor parte de la historia?',
        'options': [
          'Macondo',
          'Santa Clara',
          'Barcelona',
          'Bogotá'
        ],
        'correctIndex': 0,
        'correctResponse': '¡Muy bien! La respuesta correcta es a) Macondo, la ciudad ficticia en la que se desarrolla la mayoría de la trama de la novela.',
        'incorrectResponse': ' Incorrecto. La respuesta correcta es a) Macondo, la ciudad ficticia en "Cien años de soledad".'
      },
      {
        'q': '¿Cuál de los siguientes movimientos artísticos se caracterizó por la representación de objetos y escenas de la vida cotidiana, a menudo con un enfoque en la luz y el color?',
        'options': [
          'Cubismo',
          'Impresionismo',
          'Renacimiento',
          'Expresionismo'
        ],
        'correctIndex': 1,
        'correctResponse': '¡Exacto! La respuesta correcta es b) Impresionismo. Este movimiento artístico se centraba en la representación de la vida cotidiana y la influencia de la luz y el color en las obras.',
        'incorrectResponse': 'No es la respuesta correcta. La respuesta correcta es b) Impresionismo, que se caracterizaba por la representación de la vida cotidiana y el uso de la luz y el color.'
      },
      {
        'q': '¿Cuál es la molécula fundamental de almacenamiento y transmisión de información genética en los seres vivos?',
        'options': [
          'Proteína',
          'Carbohidrato',
          'ADN',
          'ARN'
        ],
        'correctIndex': 2,
        'correctResponse': '¡Excelente! La respuesta correcta es c) ADN (ácido desoxirribonucleico). El ADN es la molécula que almacena y transmite la información genética en los seres vivos.',
        'incorrectResponse': 'Incorrecto. La respuesta correcta es c) ADN, que es la molécula fundamental de almacenamiento genético.'
      },
      {
        'q': '¿Cuál fue el evento histórico que marcó el inicio de la Primera Guerra Mundial en 1914 cuando el archiduque Francisco Fernando de Austria-Hungría fue asesinado en Sarajevo?',
        'options': [
          'El asedio de Lieja',
          'El Tratado de Versalles',
          'El asesinato de Rasputín',
          'El asesinato de Sarajevo'
        ],
        'correctIndex': 3,
        'correctResponse': 'Correcto. El evento que marcó el inicio de la Primera Guerra Mundial fue d) El asesinato de Sarajevo, cuando el archiduque Francisco Fernando fue asesinado en 1914.',
        'incorrectResponse': 'Incorrecto. La respuesta correcta es d) El asesinato de Sarajevo, que desencadenó la Primera Guerra Mundial.'
      }
    ]
  });