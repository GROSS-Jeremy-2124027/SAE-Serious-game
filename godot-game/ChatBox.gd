extends Control

onready var chatLog = get_node("VBoxContainer/RichTextLabel")
onready var inputLabel = get_node("VBoxContainer/HBoxContainer/Label")
onready var inputField = get_node("VBoxContainer/HBoxContainer/LineEdit")


var group_index = 0
var user_name = 'Player'
var indice

func enable(stateOfPlayer):
	inputField.grab_focus()
	chatLog.bbcode_text += "\r"
	chatLog.percent_visible = 1
	if stateOfPlayer == 2 :
		get_parent().get_parent().get_node("KinematicBody2D").state = 5
	else :
		get_parent().get_parent().get_node("KinematicBody2D").state = 5
		for i in get_parent().get_node("Sombre/Q1").get_child_count() :
			get_parent().get_node("Sombre/Q1").get_child(i).get_node("CollisionMouse").visible = false

func disable(stateOfPlayer):
	inputField.release_focus()
	Input.action_release("ui_select")
	chatLog.percent_visible = 0
	if stateOfPlayer == 5 :
		if get_parent().get_node("Sombre").visible :
			get_parent().get_parent().get_node("KinematicBody2D").state = 4
		else :
			get_parent().get_parent().get_node("KinematicBody2D").state = 2
	else :
		for i in get_parent().get_node("Sombre/Q1").get_child_count() :
			get_parent().get_node("Sombre/Q1").get_child(i).get_node("CollisionMouse").visible = true

func _ready():
	inputField.connect("text_entered", self,'text_entered')
	add_message('BOT', 'tapez \'aide\' pour voir les commandes disponible')
	yield(get_tree().create_timer(5.0), "timeout")
	chatLog.percent_visible = 0

func _on_ChatBot_pressed():
	var stateOfPlayer = get_parent().get_parent().get_node("KinematicBody2D").state
	enable(stateOfPlayer)

func _on_NotChatBot_pressed():
	var stateOfPlayer = get_parent().get_parent().get_node("KinematicBody2D").state
	disable(stateOfPlayer)

func _input(event):
	if event is InputEventKey:
		var stateOfPlayer = get_parent().get_parent().get_node("KinematicBody2D").state
		if event.pressed and Input.is_action_just_pressed("ui_accept") and (stateOfPlayer == 2 or stateOfPlayer == 4) :
			enable(stateOfPlayer)
		elif event.pressed and (event.scancode == KEY_ESCAPE or (Input.is_action_just_pressed("ui_accept") and get_node("VBoxContainer/HBoxContainer/LineEdit").text == "")):
			disable(stateOfPlayer)

func add_message(username, text, color = ''):
	chatLog.bbcode_text += '\n' 
	if color != '':
		chatLog.bbcode_text += '[color=' + color + ']'
	if username != '':
		chatLog.bbcode_text += '[' + username + ']: '
	chatLog.bbcode_text += text

func text_entered(text):
	if text =='help' or text =='aide':
		add_message('BOT', 'commandes\nindice : affiche un indice pour la question en cours \nsortir : fait sortir du niveau et fait retourner au menu', '#ffffff')
		inputField.text = ''		
	elif text =='indice':
		add_message('', envoie_indice(), '#ff5757')
		inputField.text = ''
	elif text =='sortir':
		JavaScript.eval("window.location.href='../index.php'")
		inputField.text = ''
	elif text != '':
		add_message(user_name, text, '#00abc7')
		# Here you have to send the message to the server
		inputField.text = ''

func envoie_indice():
	return indice




