extends KinematicBody2D

var MAX_SPEED = 600
var ANTI_SLIPPERY = 0.4
var MAX_JUMP_TIME = 10 # en frame
var GRAVITY_FORCE = 90
var MAX_VELOCITY_Y = 2000 # pour la gravité seulement
var JUMP_FORCE = 1200

var jumpTime = 0
var velocity = Vector2(0,0)
var jumping = false

func _physics_process(delta):
	if Input.is_action_pressed("ui_left"):
		velocity.x = lerp(velocity.x,-MAX_SPEED,ANTI_SLIPPERY)
	if Input.is_action_pressed("ui_right"):
		velocity.x = lerp(velocity.x,MAX_SPEED,ANTI_SLIPPERY)
	if Input.is_action_just_pressed("ui_up") and is_on_floor():
		jumping = true
	if jumping and Input.is_action_pressed("ui_up") and jumpTime < MAX_JUMP_TIME:
		jumpTime+=1
		velocity.y = -JUMP_FORCE
	elif Input.is_action_just_released("ui_up"):
		jumpTime = 0
		jumping = false
	velocity = move_and_slide(velocity,Vector2.UP)
	velocity.x = lerp(velocity.x,0,ANTI_SLIPPERY)
	if velocity.y < MAX_VELOCITY_Y :
		velocity.y += GRAVITY_FORCE
	
