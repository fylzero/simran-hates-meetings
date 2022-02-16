describe('Authentication', () => {
    it('signs a user in', () => {
        cy.refreshDatabase();

        cy.visit('/login');
    });
});
