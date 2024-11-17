EndPoints Disponibles
1. Obtener menú
    URL: GET /menu
    Descripción: Devuelve el menú de pizzas predefinidas.
    Ejemplo de Respuesta:
    {
        "menu": [
            {
                "nombre": "Hawaiana",
                "ingredientes": ["Piña", "Jamón", "Queso"],
                "precio": 60.0
            },
            {
                "nombre": "Jamón",
                "ingredientes": ["Jamón", "Queso"],
                "precio": 50.0
            },
            {
                "nombre": "Peperoni",
                "ingredientes": ["Peperoni", "Queso"],
                "precio": 55.0
            }
        ]
    }


2. Registrar Orden
    Método: POST
    URL: /orden
    Descripción: Registra una nueva orden.
    Parámetros:
    {
        "pizzas": [
            {"tipo": "peperoni", "cantidad": 2},
            {"tipo": "jamón", "cantidad": 1},
            {"tipo": "personalizada", "cantidad": 2, "ingredientes": ["Carne", "Champiñones"]}
        ],
        "dia" : "mie"
    }

    Ejemplo de Respuesta:
    {
        "pizzas": [
            {
                "nombre": "Peperoni",
                "cantidad": 2
            },
            {
                "nombre": "Jamón",
                "cantidad": 1
            },
            {
                "nombre": "Personalizada",
                "cantidad": 2,
                "ingredientes": [
                    "Carne",
                    "Champiñones"
                ],
                "precio": 50
            }
        ],
        "total": 140
    }
