describe('Authentication', () => {
    it('signs a user in', () => {
        cy.refreshDatabase();
        cy.seed();

        cy.visit('/login');
        cy.get('#email').type('user@example.com');
        cy.get('#password').type('password');
        cy.get('#login').click();

        cy.contains('since last incident');
    });
});
