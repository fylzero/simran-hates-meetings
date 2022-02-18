describe('Authentication', () => {
    beforeEach(() => {
        cy.refreshDatabase();
        cy.seed();
    });

    it('signs a user in', () => {
        cy.visit('/login');
        cy.get('#email').type('user@example.com');
        cy.get('#password').type('password');
        cy.get('#login').click();

        cy.contains('since last incident');
    });
});
