<?php

namespace CoworkingMongo\enums;

enum ReservationStatus: string
{
  case CONFIRMED = 'confirmada';

  case PENDING = 'pendiente';
  case CANCELLED = 'cancelada';
}