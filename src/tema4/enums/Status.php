<?php

namespace Coworking\enums;

enum Status: string {
  case CONFIRMED = 'confirmada';

  case PENDING = 'pendiente';
  case CANCELLED = 'cancelada';
}
?>