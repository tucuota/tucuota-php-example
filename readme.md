# Implementación de TuCuota en PHP


En este ejemplo mostramos cómo hacer sesiones de checkout con TuCuota.
Más información en nuestra documentación:
https://tucuota.com/docs

Hará falta sacar un token de acceso en https://www.tucuota.com/dashboard/developers y ponerlo como variable de entorno `TC_API_KEY`

```bash
export TC_API_KEY=........
```

Tarjeta para hacer pruebas en sandbox:
- mastercard
- 5447651834106668

## Requerimientos
- PHP 5+

## Uso
- Subir el archivo index.php en una carpeta de tu sitio, por ejemplo `altaTuCuota`
- Dirigir a los usuarios rellenando sus datos para que se den de alta:
```
https://www.tuempresa.com/altaTuCuota/?customer_id=123&customer_name=Pedro Giménez&customer_email=pedro@gimenez.com
```