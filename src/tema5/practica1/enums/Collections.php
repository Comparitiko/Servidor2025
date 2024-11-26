<?php

namespace CoworkingMongo\enums;

enum Collections: string
{
  case USERS = 'users';

  case WORK_ROOMS = 'work-rooms';

  case RESERVATIONS = 'reservations';
}