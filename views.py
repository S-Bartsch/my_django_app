from django.shortcuts import render

def index(request):
    return render(request, 'hello/index.php')

def registrieren(request):
    return render(request, 'hello/registrieren.php')

def anmelden(request):
    return render(request, 'hello/anmelden.php')