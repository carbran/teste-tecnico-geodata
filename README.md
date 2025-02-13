# Teste Técnico Geodata

**Objetivo:** Desenvolver uma aplicação para gerenciar Projetos e Tarefas utilizando o framework
Laravel. A aplicação deve permitir criar, listar, atualizar e excluir projetos e tarefas, além de
implementar uma relação entre eles.

## Requisitos:
1. Projetos:
   1. Campos: Título (obrig.), Descrição (opc.), Data de entrega (obrig.).
   2. Funcionalidades: Criar, listar, atualizar e excluir.

2. Tarefas:
   1. Campos: Descrição (obrig.), Status (pendente/concluída - padrão: pendente), Relacionamento com um Projeto (obrig.).
   2. Funcionalidades: Criar tarefa vinculada, listar tarefas de um projeto, atualizar status e
excluir.

## Técnicos:
- Migrations, models e relacionamentos:
  - Projeto → 1:N → Tarefas.
- Controllers com regras de negócio.
- Validação de dados nos requests.
- Testes automáticos:
  - Criação de Projetos e Tarefas.
  - Validação de regras e relacionamentos.

## Bônus:
- Frontend simples (Blade e SASS)
