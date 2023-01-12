extends Control

onready var chatLog = get_node("VBoxContainer/RichTextLabel")
onready var inputLabel = get_node("VBoxContainer/HBoxContainer/Label")
onready var inputField = get_node("VBoxContainer/HBoxContainer/LineEdit")


var group_index = 0
var user_name = 'Player'
var indice

func _ready():
	
	inputField.connect("text_entered", self,'text_entered')
	add_message('BOT', 'tapez \'aide\' pour voir les commandes disponible')
	yield(get_tree().create_timer(5.0), "timeout")
	chatLog.percent_visible = 0

func _input(event):
	if event is InputEventKey:
		if event.pressed and event.scancode == KEY_ENTER:
			inputField.grab_focus()
			chatLog.bbcode_text += "\r"
			chatLog.percent_visible = 1
		if event.pressed and event.scancode == KEY_ESCAPE:
			inputField.release_focus()
			chatLog.percent_visible = 0
	
func add_message(username, text, color = ''):
	chatLog.bbcode_text += '\n' 
	if color != '':
		chatLog.bbcode_text += '[color=' + color + ']'
	if username != '':
		chatLog.bbcode_text += '[' + username + ']: '
	chatLog.bbcode_text += text


func text_entered(text):
	var pcid = get_parent().get_parent().get_node("KinematicBody2D").pcid
	if text =='help' or text =='aide':
		add_message('BOT', 'commandes\nindice : affiche un indice pour la question en cours \nsortir : fait sortir du niveau et fait retourner au menu', '#ffffff')
		inputField.text = ''		
	elif text =='indice':
		add_message('', envoie_indice(pcid), '#ff5757')
		inputField.text = ''		
	elif text =='sortir':
		JavaScript.eval("window.location.href='../index.php'")
		inputField.text = ''		
	elif text != '':
		add_message(user_name, text, '#00abc7')
		# Here you have to send the message to the server
		print(text)
		inputField.text = ''
	yield(get_tree().create_timer(5.0), "timeout")
	chatLog.percent_visible = 0

func envoie_indice(numeroIndice):
	return indice
