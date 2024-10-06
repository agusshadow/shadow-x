<section class="container py-5">
  <h2 class="mb-4">Contacto</h2>
  <p>Estamos aquí para ayudarte ¿Tienes alguna pregunta o necesitas ayuda con tu pedido? Nuestro equipo está disponible para brindarte la mejor atención. Puedes contactarnos a través de email, redes sociales o por teléfono. También puedes visitar nuestra tienda física para vivir la experiencia Shadow X en persona.</p>
  <div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Cómo puedo contactarlos por email?
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          Si prefieres escribirnos, puedes enviarnos un correo a nuestro equipo de soporte a la dirección: contacto@shadowx.com. Nos esforzamos en responder a todas las consultas en un plazo de 24 a 48 horas, brindándote la mejor asistencia para resolver cualquier duda o problema que tengas con tu pedido.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Puedo contactarlos a través de redes sociales?
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        ¡Claro que sí! Estamos disponibles en nuestras redes sociales oficiales. Puedes enviarnos un mensaje directo a través de Instagram, Facebook o Twitter y uno de nuestros representantes te responderá lo antes posible. Síguenos en nuestras cuentas para mantenerte informado sobre ofertas exclusivas, noticias y más.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Puedo comunicarme por teléfono?
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
         Si prefieres hablar directamente con nosotros, puedes llamarnos al número: +11 1234 5678. Nuestro horario de atención es de lunes a viernes, de 9:00 am a 6:00 pm. Estaremos encantados de ayudarte con cualquier consulta o soporte que necesites para tu compra o experiencia con Shadow X.
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container pb-5">

  <h2 class="py-2 mb-4">Si tenes alguna duda contactate con nosotros!</h2>

  <form action="./process-email.php" method="GET">
    <div class="mb-3">
      <label for="name" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Mail</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">Mensaje</label>
      <textarea class="form-control" id="message" rows="3" name="message"></textarea>
    </div>
    <div>
      <button type="submit" class="btn btn-success mb-3 px-5">Enviar</button>
    </div>
  </form>

</section>