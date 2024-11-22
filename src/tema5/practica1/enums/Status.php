<?php

namespace CoworkingMongo\enums;

enum Status: string
{
  case CONFIRMED = 'confirmada';

  case PENDING = 'pendiente';
  case CANCELLED = 'cancelada';
}